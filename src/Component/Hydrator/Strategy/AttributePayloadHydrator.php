<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\ElementNestedDTO;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class AttributePayloadHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em)
    {
        /** @var Attribute $attribute */
        $attribute = $data['attribute'];

        $dto->setTitle($attribute->getTitle());
        $dto->setCategoryTitle($attribute->getCategory()->getTitle());
        $dto->setCategoryUuid($attribute->getCategory()->getUuid());
        $dto->setUuid($attribute->getUuid());

        if ($attribute->getDescription()) {
            $dto->setDescription($attribute->getDescription());
        }

        if ($attribute->getExample()) {
            $dto->setExample($attribute->getExample());
        }

        // add elements to attribute
        $attributeUuid = $attribute->getUuid();
        $model = $attribute->getCategory()->getModel();
        if ($model !== null) {
            switch ($model) {
                case CategoryPayloadDTO::MODEL_NUMBER:
                    // select all numbers with this attribute
//                    $elements = $em->getRepository(Number::class)->getAttributes($attributeUuid);
                    $dto->setModel(CategoryPayloadDTO::MODEL_NUMBER);
                    break;
                case CategoryPayloadDTO::MODEL_FILM:
                    // select all films with this attribute
//                    $elements = $em->getRepository(Film::class)->getAttributes($attributeUuid);
                    $dto->setModel(CategoryPayloadDTO::MODEL_FILM);
                    break;
                case CategoryPayloadDTO::MODEL_SONG:
                    // select all songs with this attribute
//                    $elements = $em->getRepository(Song::class)->getAttributes($attributeUuid);
                    $dto->setModel(CategoryPayloadDTO::MODEL_SONG);
                    break;
                default:
                    throw new \Error($model.' is not a correct category model');
            }
        }
//
//        if (isset($elements)) {
//            foreach ($elements as $element) {
//                $elementDTO = DTOFactory::create(ModelConstants::ELEMENT_NESTED_DTO_MODEL);
//                $elementDTO = NestedElementInAttributeHydrator::hydrate($elementDTO, ['element' => $element], $em);
//                $elementsNestedDTOList[] = $elementDTO;
//            }
//            if (isset($elementsNestedDTOList)) {
//                $dto->setElements($elementsNestedDTOList);
//            }
//        }
    }

}