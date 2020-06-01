<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class CategoryPayloadDTO
 * @package App\Component\DTO\Payload
 */
class CategoryPayloadDTO extends AbstractUniqueDTO
{
    CONST CURRENT_MODEL = 'other';
    CONST MODEL_NUMBER = 'number';
    CONST MODEL_FILM = 'film';
    CONST MODEL_SONG = 'song';

    /** @var string */
    private $title;

    /** @var string */
    private $description = '';

    /** @var string */
    private $model;

    /** @var array */
    private $attributes;

    /** @var int */
    private $attributesCount;

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