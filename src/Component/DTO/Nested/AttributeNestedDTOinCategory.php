<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class AttributeNestedDTOinCategory
 * @package App\Component\DTO\Nested
 */
class AttributeNestedDTOinCategory extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var null|string */
    private $description = '';

    /** @var null|string */
    private $example= '';

    /** @var null|int */
    private $elementsCount = 0;

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
    public function getExample(): ?string
    {
        return $this->example;
    }

    /**
     * @param string $example
     */
    public function setExample(string $example): void
    {
        $this->example = $example;
    }

    /**
     * @return int|null
     */
    public function getElementsCount(): ?int
    {
        return $this->elementsCount;
    }

    /**
     * @param int|null $elementsCount
     */
    public function setElementsCount(?int $elementsCount): void
    {
        $this->elementsCount = $elementsCount;
    }

}