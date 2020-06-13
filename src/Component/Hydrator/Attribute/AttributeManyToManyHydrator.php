<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Attribute;


use App\Component\DTO\Definition\DTOInterface;
use App\Entity\Attribute;

/**
 * Class AttributeManyToManyHydrator
 * @package App\Component\Hydrator\Attribute
 */
class AttributeManyToManyHydrator
{
    public static function prepareManyToMany(string $code, Attribute $attribute)
    {
        if ($code === 'completeness_thesaurus') {
            $manyToManyAttributes['completeness'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'dancemble') {
            $manyToManyAttributes['danceEnsemble'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'musensemble') {
            $manyToManyAttributes['musicalEnsemble'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'source_thesaurus') {
            $manyToManyAttributes['source'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'imaginary') {
            $manyToManyAttributes['imaginaryPlace'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'diegetic_place_thesaurus') {
            $manyToManyAttributes['diegeticPlace'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'exoticism_thesaurus') {
            $manyToManyAttributes['exoticism'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'musical_thesaurus') {
            $manyToManyAttributes['musicalStyle'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'tempo_thesaurus') {
            $manyToManyAttributes['tempo'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'quotation_thesaurus') {
            $manyToManyAttributes['quotation'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'dance_subgenre') {
            $manyToManyAttributes['danceSubgenre'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'genre') {
            $manyToManyAttributes['topic'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'stereotype') {
            $manyToManyAttributes['ethnicStereotypes'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'dancing_type') {
            $manyToManyAttributes['dancingType'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }

        if ($code === 'dance_content') {
            $manyToManyAttributes['danceContent'][] = $attribute->getTitle();
            return $manyToManyAttributes;
        }
    }

    /**
     * @param string $categoryName
     * @param string $legacyAttributeName
     * @param string $currentAttributeName
     * @param array $manyToManyAttributes
     * @param DTOInterface $dto
     * @return DTOInterface
     */
    public static function setOneManyToManyAttribute(
        string $categoryName,
        string $legacyAttributeName ,
        string $currentAttributeName,
        array $manyToManyAttributes,
        DTOInterface $dto
    ):DTOInterface
    {
        if ($categoryName === $legacyAttributeName) {
            if (isset($manyToManyAttributes[$currentAttributeName])) {
                $setter = 'set'.ucfirst($currentAttributeName);
                $dto->$setter($manyToManyAttributes[$currentAttributeName]);
            }
        }

        return $dto;
    }

    /**
     * @param array $configuration
     * @param string $category
     * @param array $manyToManyAttributes
     * @param DTOInterface $dto
     * @return DTOInterface
     */
    public static function handleManyToManyAttribute(array $configuration, string $category, array $manyToManyAttributes, DTOInterface $dto):DTOInterface
    {
        for ($i = 0; $i < count($configuration); $i++) {
            $dto =  self::setOneManyToManyAttribute($category, $configuration[$i]['legacy'], $configuration[$i]['current'], $manyToManyAttributes, $dto);
        }

        return $dto;
    }

    /**
     * @param array $manyToManyAttributes
     * @param array $manyToMany
     * @param DTOInterface $dto
     * @param array $configuration
     */
    public static function setAllManyToManyAttributes(array $manyToManyAttributes, array $manyToMany, DTOInterface $dto, array $configuration):DTOInterface
    {
        // for attributes again: set many to many
        foreach ($manyToMany as $category) {
            $dto =  AttributeManyToManyHydrator::handleManyToManyAttribute($configuration, $category, $manyToManyAttributes, $dto);
        }

        return $dto;
    }

}