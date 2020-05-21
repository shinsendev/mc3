<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class AttributeNestedDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var null|string */
    private $description;

    /** @var null|string */
    private $example;

    /** @var null|int */
    private $elementsCount;

    public function hydrate(array $data, EntityManagerInterface $em):void
    {
        /** @var Attribute $attribute */
        $attribute = $data['attribute'];

        $this->setTitle($attribute->getTitle());
        $uuid = $attribute->getUuid();
        $this->setUuid($uuid); //e3c612ea-0575-46e9-a971-4498e85d8ff

        // optional params
        if ($description = $attribute->getDescription()) {
            $this->setDescription($description);
        }
        if ($example = $attribute->getExample()) {
            $this->setExample($example);
        }

        // set elements if it's not "other"
        if ($data['model'] !== CategoryPayloadDTO::model) {
            switch ($data['model']) {
                case 'number':
                    // select all numbers with this attribute
                    $this->setElementsCount($em->getRepository(Number::class)->countAttributes($uuid));
                    break;
                case 'film':
                    // select all films with this attribute
                    $this->setElementsCount($em->getRepository(Film::class)->countAttributes($uuid));
                    break;
                case 'song':
                    // select all songs with this attribute
                    $this->setElementsCount($em->getRepository(Song::class)->countAttributes($uuid));
                    break;
                default:
                    throw new \Error($data['model'].' is not a correct category model');
            }
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