<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Entity\Attribute;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="category"
 * )
 */
class CategoryPayloadDTO extends AbstractUniqueDTO
{
    CONST model = 'other';

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $model;

    /** @var array */
    private $attributes;

    /** @var int */
    private $attributesCount;

    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        /** @var Category $category */
        $category = $data['category'];
        $this->setTitle($category->getTitle());
        $this->setUuid($category->getUuid());

        // catch empty models
        if ($category->getModel()) {
            $model = $category->getModel();
        }
        else {
            $model = self::model;
        }
        $this->setModel($model);

        // optional params
        if ($category->getDescription()) {
            $this->setDescription($category->getDescription());
        }

        // add nested attributes DTO
        $attributes = $category->getAttributes();
        $this->setAttributesCount(count($attributes));

        foreach ($attributes as $attribute)
        {
            $attributeDTO = new AttributeNestedDTO();
            $attributeDTO->hydrate(['attribute' => $attribute, 'model' => $model], $em);
            $attributesList[] = $attributeDTO;
        }

        if (isset($attributesList)) {
            $this->setAttributes($attributesList);
        }
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    /**
     * @return array
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return int
     */
    public function getAttributesCount(): int
    {
        return $this->attributesCount;
    }

    /**
     * @param int $attributesCount
     */
    public function setAttributesCount(int $attributesCount): void
    {
        $this->attributesCount = $attributesCount;
    }
}