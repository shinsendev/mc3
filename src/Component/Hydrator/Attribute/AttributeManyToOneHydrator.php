<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Attribute;


use App\Component\DTO\Definition\DTOInterface;
use App\Entity\Attribute;

class AttributeManyToOneHydrator
{
    /**
     * @param string $code
     * @param Attribute $attribute
     * @param DTOInterface $dto
     * @param array $manyToOneExceptions
     * @return DTOInterface
     */
    public static function setManyToOneThesaurus(string $code, Attribute $attribute, DTOInterface $dto, array $manyToOneExceptions)
    {
        foreach ($manyToOneExceptions as $exception) {
            if ($exception['legacy'] === $code) {
                $setter = 'set'.ucfirst($exception['current']);
                $dto->$setter($attribute->getTitle());
                return $dto;
            }
        }
    }
}