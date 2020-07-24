<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Attribute;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Helper\AttributeHelper;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AttributeManyToManyHydrator
 * @package App\Component\Hydrator\Attribute
 */
class AttributeManyToManyHydrator
{
    /**
     * @param string $currentCode
     * @param Attribute $attribute
     * @param array $manyToManyAttributes
     * @param EntityManagerInterface $em
     * @return array
     */
    public static function addOneManyToManyAttribute(string $currentCode, Attribute $attribute, array $manyToManyAttributes, EntityManagerInterface $em):array
    {
        $manyToManyAttributes[$currentCode][] = [AttributeHelper::getAttribute($attribute, $em)];

        return $manyToManyAttributes;
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
     * @param DTOInterface $dto
     * @param array $configuration
     * @return DTOInterface
     */
    public static function setAllManyToManyAttributes(array $manyToManyAttributes, DTOInterface $dto, array $configuration):DTOInterface
    {
        // for attributes again: set many to many
        foreach ($configuration as $code) {
            $dto =  AttributeManyToManyHydrator::handleManyToManyAttribute($configuration, $code['legacy'], $manyToManyAttributes, $dto);
        }

        return $dto;
    }

}