<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Helper;

use App\Component\DTO\Definition\DTOInterface;
use App\Entity\Attribute;
use Doctrine\ORM\PersistentCollection;

class AttributeHelper
{
    /**
     * @param PersistentCollection $attributes
     * @param array $attributeConfiguration
     * @param DTOInterface $dto
     * @return DTOInterface
     */
    public static function setAttributes(PersistentCollection $attributes, array $attributeConfiguration, DTOInterface $dto) {
        foreach($attributes as $attribute) {
            // we check if there is a special configuration for each attributes
            if (!$configuration = self::getProperty($attributeConfiguration, $attribute->getCategory()->getCode())) {
                $dto = self::setAttribute($attribute, $dto);
            }
            // if there is, we add the corresponding configuration
            $dto = self::setAttribute($attribute, $dto, $configuration);
        }

        return $dto;
    }

    /**
     * @param array $attributeConfiguration
     * @param string $code
     * @return mixed
     */
    public static function getProperty(Array $attributeConfiguration, string $code)
    {
        foreach ($attributeConfiguration as $configuration) {
            // it is a special attribute that needs configuration, we need to link it
            if ($code === $configuration['initialProperty'])
            {
                return $configuration;
            }
        }
    }

    /**
     * @param Attribute $attribute
     * @param DTOInterface $dto
     * @param array $configuration
     * @return DTOInterface
     */
    public static function setAttribute(Attribute $attribute, DTOInterface $dto, $configuration = [])
    {
        if (isset($configuration['convertedProperty'])) {
            $setter = 'set'.ucfirst($configuration['convertedProperty']);
        }

        else {
            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
        }
        $dto->$setter($attribute->getTitle());

        return $dto;
    }
}