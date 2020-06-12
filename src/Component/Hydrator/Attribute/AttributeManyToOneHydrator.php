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
        if ($code === 'performance_thesaurus') {
            $dto->setPerformance($attribute->getTitle());
            return $dto;
        }

        if ($code === 'musician_thesaurus') {
            $dto->setVisibleMusicians($attribute->getTitle());
            return $dto;
        }

        if ($code === 'begin_thesaurus') {
            $dto->setBeginning($attribute->getTitle());
            return $dto;
        }

        if ($code === 'ending_thesaurus') {
            $dto->setEnding($attribute->getTitle());
            return $dto;
        }

        if ($code === 'spectators_thesaurus') {
            $dto->setSpectators($attribute->getTitle());
            return $dto;
        }

        if ($code === 'complet_options') {
            $dto->setCompletenessOption($attribute->getTitle());
            return $dto;
        }
    }
}