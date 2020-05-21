<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="attribute",
 *     itemOperations={"get"},
 *     collectionOperations={
 *         "get"={
 *             "controller"= NotFoundController::class,
 *             "read"=false,
 *             "output"=false,
 *         }
 *     }
 * )
 */
class AttributePayloadDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var string */
    private $categoryName;

    /** @var string */
    private $categoryUuid;

    /** @var void|string */
    private $description;

    /** @var void|string */
    private $example;

    /** @var void|array */
    private $elements;

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
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     */
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }

    /**
     * @return string
     */
    public function getCategoryUuid(): string
    {
        return $this->categoryUuid;
    }

    /**
     * @param string $categoryUuid
     */
    public function setCategoryUuid(string $categoryUuid): void
    {
        $this->categoryUuid = $categoryUuid;
    }

    /**
     * @return string|void
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string|void $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return string|void
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param string|void $example
     */
    public function setExample($example): void
    {
        $this->example = $example;
    }

    /**
     * @return array|void
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array|void $elements
     */
    public function setElements($elements): void
    {
        $this->elements = $elements;
    }

}