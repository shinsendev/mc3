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

class NestedCoworkerPayloadHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Person $person */
        $person = $data['person'];

        // if it's a group, no need to get first and last names
        if ($person->getGroupname()) {
            $dto->setFullname($person->getGroupname());
        }

        else {
            if ($person->getFirstname() || $person->getLastname()) {
                $dto->setFullname($person->getFirstname().' '.$person->getLastname());
            }
        }

        $dto->setUuid($person->getUuid());
        $dto->setCount($data['count']);

        /** @var CoworkerNestedDTO */
        return $dto;
    }
}