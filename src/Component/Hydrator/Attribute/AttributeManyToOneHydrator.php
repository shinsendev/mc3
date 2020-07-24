<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Attribute;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Helper\AttributeHelper;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;

class AttributeManyToOneHydrator
{
    /**
     * @param string $code
     * @param Attribute $attribute
     * @param DTOInterface $dto
     * @param array $manyToOneExceptions
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function setManyToOneThesaurus(string $code, Attribute $attribute, DTOInterface $dto, array $manyToOneExceptions, EntityManagerInterface $em)
    {
        foreach ($manyToOneExceptions as $exception) {
            if ($exception['legacy'] === $code) {
                $setter = 'set'.ucfirst($exception['current']);
                $dto->$setter([AttributeHelper::getAttribute($attribute, $em)]);
                return $dto;
            }
        }
    }
}