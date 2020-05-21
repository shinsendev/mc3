<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
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
    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $model;

    /** @var array */
    private $attributes;

    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        /** @var Category $category */
        $category = $data['category'];
        $this->setTitle($category->getTitle());
        $this->setDescription($category->getDescription());
        $this->setUuid($category->getUuid());
        $this->setModel($category->getModel());

        // add attributes DTO
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
    public function getDescription(): string
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
    public function getAttributes(): array
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
}