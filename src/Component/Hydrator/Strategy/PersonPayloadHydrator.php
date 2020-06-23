<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Person;
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

        // we don't use hydrate basics because it's a very simple model
        $person->setViaf($dto->getViaf());
        $dto->setUuid($person->getUuid());

        // get films
        //  title, released data, total
        $dto = self::setFilms($dto, $em);

        // get numbers
        $dto = self::setNumbers($dto, $em);

        // get persons connected

        // get stats
        //todo: to complete
        // add  length of the numbers in the film,  total length of the numbers with person in the film, ratio is computed on client side

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
     * @param PersonPayloadDTO $dto
     * @param EntityManagerInterface $em
     */
    public static function setNumbers(PersonPayloadDTO $dto, EntityManagerInterface $em)
    {
        // get all number linked to this person (with pagination see above)
        $numbers = $em->getRepository(Person::class)->findPaginatedRelatedNumbers($dto->getUuid(), 1000, 0);
        
        // get films with direct relation between person and films (ex:director)
        $numbersRelated = [];
        foreach ($numbers as $response) {
            $numberDTO = DTOFactory::create(ModelConstants::NUMBER_NESTED_IN_PERSON_DTO_MODEL);
            $numbersRelated[] = NestedNumberInPersonHydrator::hydrate($numberDTO, $response, $em);
        }

        if ($numbersRelated) {
            $dto->setRelatedNumbersByProfession($numbersRelated);
        }

        return $dto;
    }

    public static function getPersons()
    {

    }

}