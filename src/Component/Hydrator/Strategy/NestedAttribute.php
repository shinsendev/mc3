<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Component\Hydrator\Description\HydratorInterface;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NestedAttribute
 * @package App\Component\Hydrator\Strategy
 */
class NestedAttribute implements HydratorInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):AttributeNestedDTO
    {
        //todo : use an abstract

        /** @var Attribute $attribute */
        $attribute = $data['attribute'];

        /** @var AttributeNestedDTO $dto */
        $dto->setTitle($attribute->getTitle());
        $uuid = $attribute->getUuid();
        $dto->setUuid($uuid); //e3c612ea-0575-46e9-a971-4498e85d8ff

        return $dto;
    }
}