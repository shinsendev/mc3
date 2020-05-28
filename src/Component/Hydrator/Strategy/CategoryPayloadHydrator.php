<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryPayloadHydrator
 * @package App\Component\Hydrator\Strategy
 */
class CategoryPayloadHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface|CategoryPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):CategoryPayloadDTO
    {
        /** @var Category $category */
        $category = $data['category'];

        /** @var CategoryPayloadDTO $dto */
        $dto->setTitle($category->getTitle());
        $dto->setUuid($category->getUuid());

        // catch empty models
        if ($category->getModel()) {
            $model = $category->getModel();
        }
        else {
            $model = CategoryPayloadDTO::CURRENT_MODEL;
        }
        $dto->setModel($model);

        // optional params
        if ($category->getDescription()) {
            $dto->setDescription($category->getDescription());
        }

        // add nested attributes DTO
        $attributes = $category->getAttributes();
        $dto->setAttributesCount(count($attributes));

        foreach ($attributes as $attribute)
        {
            $attributeDTO = DTOFactory::create(ModelConstants::ATTRIBUTE_NESTED_IN_CATEGORY_MODEL);
            NestedAttributeInCategory::hydrate($attributeDTO, ['attribute' => $attribute, 'model' => $model], $em);
            $attributesList[] = $attributeDTO;
        }

        if (isset($attributesList)) {
            $dto->setAttributes($attributesList);
        }

        return $dto;
    }

}