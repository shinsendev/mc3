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
        $filmsConnected = self::setFilms($dto, $em);

        // get numbers

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
        $films = $em->getRepository(Person::class)->findPaginatedRelatedFilms($dto->getUuid(), 500, 0);

        // we don't really use pagination, it's more a security to limit to 500 items but it never supposed to happen that a person is connected to so many movies
        foreach ($films as $film) {
            // we hydrate
            $filmDTO = DTOFactory::create(ModelConstants::FILM_NESTED_IN_PERSON_DTO_MODEL);
            NestedFilmInPersonHydrator::hydrate($filmDTO, ['film' => $film], $em);

            dump($films->count());
            dd($film);
        }

        return $dto;
    }

    public static function getNumbers()
    {

    }

    public static function getPersons()
{

}

}