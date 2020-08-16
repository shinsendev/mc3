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
        $model = $attribute->getCategory()->getModel();
        if ($model !== null) {
            switch ($model) {
                case CategoryPayloadDTO::MODEL_NUMBER:
                    $dto->setModel(CategoryPayloadDTO::MODEL_NUMBER);
                    break;
                case CategoryPayloadDTO::MODEL_FILM:
                    $dto->setModel(CategoryPayloadDTO::MODEL_FILM);
                    break;
                case CategoryPayloadDTO::MODEL_SONG:
                    $dto->setModel(CategoryPayloadDTO::MODEL_SONG);
                    break;
                default:
                    throw new \Error($model.' is not a correct category model');
            }
        }

    }

}