<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\Hydrator\Description\HydratorInterface;
use App\Entity\Attribute;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

class NestedAttributeInCategory implements HydratorInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):AttributeNestedDTO
    {
        /** @var Attribute $attribute */
        $attribute = $data['attribute'];

        /** @var AttributeNestedDTO $dto */
        $dto->setTitle($attribute->getTitle());
        $uuid = $attribute->getUuid();
        $dto->setUuid($uuid); //e3c612ea-0575-46e9-a971-4498e85d8ff

        // optional params
        if ($description = $attribute->getDescription()) {
            $dto->setDescription($description);
        }
        if ($example = $attribute->getExample()) {
            $dto->setExample($example);
        }

        // set elements if it's not "other"
        if (isset($data['model']) && $data['model'] !== CategoryPayloadDTO::CURRENT_MODEL) {
            switch ($data['model']) {
                case CategoryPayloadDTO::MODEL_NUMBER:
                    // count all numbers with this attribute
                    $dto->setElementsCount($em->getRepository(Number::class)->countAttributes($uuid));
                    break;
                case CategoryPayloadDTO::MODEL_FILM:
                    // count all films with this attribute
                    $dto->setElementsCount($em->getRepository(Film::class)->countAttributes($uuid));
                    break;
                case CategoryPayloadDTO::MODEL_SONG:
                    // count all songs with this attribute
                    $dto->setElementsCount($em->getRepository(Song::class)->countAttributes($uuid));
                    break;
                default:
                    throw new \Error($data['model'].' is not a correct category model');
            }
        }

        return $dto;
    }
}