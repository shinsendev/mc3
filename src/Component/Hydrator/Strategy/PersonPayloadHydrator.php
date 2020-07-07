<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\CoworkerNestedDTO;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Person;
use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;

class PersonPayloadHydrator implements HydratorDTOInterface
{
    const GROUP_TYPE = 'group';
    const PERSON_TYPE = 'person';

    /**
     * @param PersonPayloadDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Person $person */
        $person = $data['person'];

        // if it's a group, no need to get first and last names
        if ($person->getGroupname()) {
            $dto->setFullname($person->getGroupname());
            $dto->setType(self::GROUP_TYPE);
        }

        else {
            if ($person->getFirstname() || $person->getLastname()) {
                $dto->setFullname($person->getFirstname().' '.$person->getLastname());
                $dto->setType(self::PERSON_TYPE);
            }
        }

        if ($person->getGender()) {
            $dto->setGender($person->getGender());
        }

        // we don't use hydrate basics because it's a very simple model
        $person->setViaf($dto->getViaf());
        $dto->setUuid($person->getUuid());

        // get films
        //  title, released data, total
        $dto = self::setFilms($dto, $em);

        // get numbers
        $dto = self::setNumbers($dto, $em);

        // get persons connected
        $dto = self::setPersons($dto, $em);

        // get stats
        $statsRepository = $em->getRepository(Statistic::class);

        if ($personStats = $statsRepository->findOneByTargetUuid($person->getUuid())) {
            $value = $personStats->getValue();

            if (isset($value['averageShotLength'])) {
                $dto->setAverageShotLength($value['averageShotLength']);
            }

            if (isset($value['films'])) {
                $dto->setPresenceInFilms($value['films']);
            }
        }

        return $dto;
    }

    /**
     * @param PersonPayloadDTO $dto
     * @param EntityManagerInterface $em
     * @return PersonPayloadDTO
     */
    public static function setFilms(PersonPayloadDTO $dto, EntityManagerInterface $em):PersonPayloadDTO
    {
        // we don't really use pagination, it's more a security to limit to 500 items but it never supposed to happen that a person is connected to so many movies

        $films = $em->getRepository(Person::class)->findPaginatedRelatedFilms($dto->getUuid(), 500, 0);

        // get films with direct relation between person and films (ex:director)
        $filmsDirectlyConnected = [];
        foreach ($films as $film) {
            $filmDTO = DTOFactory::create(ModelConstants::FILM_NESTED_DTO_MODEL);
            $filmsDirectlyConnected[] = NestedFilmHydrator::hydrate($filmDTO, ['film' => $film], $em);
        }

        // get films with indirect relation by numbers (ex:performers)
        $filmsConnectedByNumbers = [];
        $filmsByNumber = $em->getRepository(Person::class)->findPaginatedRelatedFilmsByNumbers($dto->getUuid(), 500, 0);

        foreach ($filmsByNumber as $film) {
            $filmDTO = DTOFactory::create(ModelConstants::FILM_NESTED_DTO_MODEL);
            $filmsConnectedByNumbers[] = NestedFilmHydrator::hydrate($filmDTO, ['film' => $film], $em);
        }

        // merge array and remove non unique
        $filmsConnected = array_unique(array_merge($filmsDirectlyConnected,$filmsConnectedByNumbers), SORT_REGULAR);

        // sort array by released date (fn just for PHP7.4 +)
        usort($filmsConnected, fn($a, $b) => $a->getReleasedYear()> $b->getReleasedYear());

        if ($filmsConnected) {
            $dto->setRelatedFilms($filmsConnected);
        }

        return $dto;
    }

    /**
     * @param array $data
     * @param string $uuid
     * @return int|null
     */
    protected static function getExistingNumberIndex(array $data, string $uuid): ?int
    {
        foreach ($data as $index => $number) {
            if ($number->getUuid() === $uuid) {
                return $index;
            }
        }

        return null;
    }

    /**
     * @param PersonPayloadDTO $dto
     * @param EntityManagerInterface $em
     */
    public static function setNumbers(PersonPayloadDTO $dto, EntityManagerInterface $em)
    {
        // get all number linked to this person (with pagination see above)
        if ($numbers = $em->getRepository(Person::class)->findRelatedNumbersWithNativeSQL($dto->getUuid())) {
            // get films with direct relation between person and films (ex:director)
            foreach ($numbers as $response) {
                $numberDTO = DTOFactory::create(ModelConstants::NUMBER_NESTED_IN_PERSON_DTO_MODEL);
                $numbersRelated[] = NestedNumberInPersonHydrator::hydrate($numberDTO, ['number' => $response], $em);
            }

            // merge same persons?
            $uniqueNumbersList = [];
            foreach ($numbersRelated as $number) {

                // we check if  the number uuid is in $uniqueNumbersList
                if ($index = self::getExistingNumberIndex($uniqueNumbersList, $number->getUuid())) {
                    // we find the corresponding number in $uniqueNumbersList and add the profession
                    $uniqueNumbersList[$index]->addProfession($number->getProfessions()[0]);
                }
                // we add the number
                else {
                    $uniqueNumbersList[] = $number;
                }
            }

            if (isset($numbersRelated)) {
                $dto->setRelatedNumbers($uniqueNumbersList);
            }
        }

        return $dto;
    }

    /**
     * @param PersonPayloadDTO $dto
     * @param EntityManagerInterface $em
     * @return PersonPayloadDTO|void
     */
    public static function setPersons(PersonPayloadDTO $dto, EntityManagerInterface $em):PersonPayloadDTO
    {
        $personUuid = $dto->getUuid();

        // get all numbers where the person has been a performer
        $numbers = $em->getRepository(Person::class)->findNumbersWherePerforming($personUuid);

        foreach ($numbers as $number) {
            $numbersList[] = $number['uuid'];
        }

        // if there is no numbers, we don't need to go further
        if (!isset($numbersList)) {
            return $dto;
        }

        // get all choreographers
        $choreographers = $em->getRepository(Person::class)->findChoreographersGroupedByNumbers($numbers);
        foreach ($choreographers as $data) {

            /** @var CoworkerNestedDTO $coworker */
            $choreographerDTO = DTOFactory::create(ModelConstants::PERSON_COWORKER);
            $choreographerDTO = NestedCoworkerPayloadHydrator::hydrate($choreographerDTO, $data, $em);
            $choreographersDTO[] = $choreographerDTO;
        }

        if (isset($choreographersDTO)) {
            $dto->setChoregraphers($choreographersDTO);
        }

        // get all composers
        $composers = $em->getRepository(Person::class)->findSongCoworkersGroupedByNumbers($numbers, 'composer');
        foreach ($composers as $data) {
            /** @var CoworkerNestedDTO $coworker */
            $coworkerDTO = DTOFactory::create(ModelConstants::PERSON_COWORKER);
            $coworkerDTO = NestedCoworkerPayloadHydrator::hydrate($coworkerDTO, $data, $em);
            $composersDTO[] = $coworkerDTO;
        }

        if (isset($composersDTO)) {
            $dto->setComposers($composersDTO);
        }

        // get all lyricists
        $lyricists = $em->getRepository(Person::class)->findSongCoworkersGroupedByNumbers($numbers, 'lyricist');
        foreach ($lyricists as $data) {
            /** @var CoworkerNestedDTO $coworker */
            $coworkerDTO = DTOFactory::create(ModelConstants::PERSON_COWORKER);
            $coworkerDTO = NestedCoworkerPayloadHydrator::hydrate($coworkerDTO, $data, $em);
            $lyricistsDTO[] = $coworkerDTO;
        }

        if (isset($lyricistsDTO)) {
            $dto->setLyricists($lyricistsDTO);
        }

        /** @var PersonPayloadDTO */
        return $dto;
    }

}