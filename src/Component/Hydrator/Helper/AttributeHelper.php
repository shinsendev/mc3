<?php


namespace App\Component\Hydrator\Helper;


use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\NestedAttribute;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;

class AttributeHelper
{
    /**
     * @param Attribute $attribute
     * @param EntityManagerInterface $em
     * @return AttributeNestedDTO
     */
    public static function getAttribute(Attribute $attribute, EntityManagerInterface $em):AttributeNestedDTO
    {
        $nestedAttributeDTO = DTOFactory::create(ModelConstants::ATTRIBUTE_NESTED_PAYLOAD);

        return NestedAttribute::hydrate($nestedAttributeDTO, ['attribute' => $attribute], $em);
    }
}