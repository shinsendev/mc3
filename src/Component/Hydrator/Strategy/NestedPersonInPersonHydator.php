<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\PersonNestedInPersonDTO;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use Doctrine\ORM\EntityManagerInterface;

class NestedPersonInPersonHydator implements HydratorDTOInterface
{
    /**
     * @param PersonNestedInPersonDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Number $number */
        $person = $data['person'];
        $profession = $data['profession'];

        // if it's a group, no need to get first and last names
        if ($person->getGroupname()) {
            $dto->setFullname($person->getGroupname());
            $dto->setType(PersonPayloadDTO::GROUP);
        }

        else {
            if ($person->getFirstname() || $person->getLastname()) {
                $dto->setFullname($person->getFirstname().' '.$person->getLastname());
                $dto->setType(PersonPayloadDTO::PERSON);
            }
        }

        if ($person->getGender()) {
            $dto->setGender($person->getGender());
        }

        $dto->setUuid($person->getUuid());
        $dto->setProfession($profession);

        return $dto;
    }
}