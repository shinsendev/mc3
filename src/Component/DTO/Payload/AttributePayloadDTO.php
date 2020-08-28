<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\ElementNestedDTO;
use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AttributePayloadDTO
 * @package App\Component\DTO\Payload
 */
class AttributePayloadDTO extends AbstractUniqueDTO
{
    private string $title;
    private string $categoryTitle;
    private string $categoryUuid;
    private string $description = '';
    private string $example= '';
    private string $model = ''; // model type of the element linked to this attribute : number, song, film
    private array $countByYears = [];

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
    public function getCategoryTitle(): string
    {
        return $this->categoryTitle;
    }

    /**
     * @param string $categoryTitle
     */
    public function setCategoryTitle(string $categoryTitle): void
    {
        $this->categoryTitle = $categoryTitle;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param string $example
     */
    public function setExample($example): void
    {
        $this->example = $example;
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
    public function getCountByYears(): array
    {
        return $this->countByYears;
    }

    /**
     * @param array $countByYears
     */
    public function setCountByYears(array $countByYears): void
    {
        $this->countByYears = $countByYears;
    }

}