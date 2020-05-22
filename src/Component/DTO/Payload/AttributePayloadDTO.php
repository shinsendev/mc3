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
    private $categoryTitle;

    /** @var string */
    private $categoryUuid;

    /** @var void|string */
    private $description;

    /** @var void|string */
    private $example;

    /** @var void|array */
    private $elements;

    public function hydrate(array $data, EntityManagerInterface $em)
    {
        /** @var Attribute $attribute */
        $attribute = $data['attribute'];
        $attributeUuid = $attribute->getUuid();
        $this->setTitle($attribute->getTitle());
        $this->setCategoryTitle($attribute->getCategory()->getTitle());
        $this->setCategoryUuid($attribute->getCategory()->getUuid());
        $this->setUuid($attribute->getUuid());

        if ($attribute->getDescription()) {
            $this->setDescription($attribute->getDescription());
        }

        if ($attribute->getExample()) {
            $this->setExample($attribute->getExample());
        }

        // add elements to attribute
        $model = $attribute->getCategory()->getModel();
        if ($model !== null) {
            switch ($model) {
                case CategoryPayloadDTO::MODEL_NUMBER:
                    // select all numbers with this attribute
                    $elements = $em->getRepository(Number::class)->getAttributes($attributeUuid);
                    break;
                case CategoryPayloadDTO::MODEL_FILM:
                    // select all films with this attribute
                    $elements = $em->getRepository(Film::class)->getAttributes($attributeUuid);
                    break;
                case CategoryPayloadDTO::MODEL_SONG:
                    // select all songs with this attribute
                    $elements = $em->getRepository(Song::class)->getAttributes($attributeUuid);
                    break;
                default:
                    throw new \Error($model.' is not a correct category model');
            }
        }

        if (isset($elements)) {
            foreach ($elements as $element) {
                $elementDTO = new ElementNestedDTO();
                $elementDTO->hydrate(['element' => $element], $em);
                $elementsNestedDTOList[] = $elementDTO;
            }
            if (isset($elementsNestedDTOList)) {
                $this->setElements($elementsNestedDTOList);
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