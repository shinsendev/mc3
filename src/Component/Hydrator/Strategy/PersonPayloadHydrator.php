<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Description\HydratorDTOInterface;
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

        $dto->setUuid($person->getUuid());

        //todo: to complete

        return $dto;
    }

}