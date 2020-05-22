<?php

declare(strict_types=1);


namespace App\Component\Factory;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Hierarchy\AbstractDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Payload\AttributePayloadDTO;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\HomePayloadDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Component\Model\ModelConstants;

class DTOFactory
{
    /**
     * @param string $entityName
     * @return mixed
     */
    public static function create(string $entityName):DTOInterface
    {
        $config = [
            ModelConstants::SONG_PAYLOAD_MODEL => new SongPayloadDTO(),
            ModelConstants::NUMBER_PAYLOAD_MODEL => new NumberPayloadDTO(),
            ModelConstants::FILM_PAYLOAD_MODEL => new FilmPayloadDTO(),
            ModelConstants::NESTED_FILM_MODEL => new FilmNestedDTO(),
            ModelConstants::ATTRIBUTE_PAYLOAD_MODEL => new AttributePayloadDTO(),
            ModelConstants::CATEGORY_PAYLOAD_MODEL => new CategoryPayloadDTO(),
            ModelConstants::PERSON_PAYLOAD_MODEL => new PersonPayloadDTO(),
            ModelConstants::HOME_PAYLOAD_MODEL => new HomePayloadDTO(),
        ];

        foreach ($config as $configEntityName => $entity) {
            if ($entityName === $configEntityName) {
                return $entity;
            }
        }
    }
}