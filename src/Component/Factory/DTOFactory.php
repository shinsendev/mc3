<?php

declare(strict_types=1);


namespace App\Component\Factory;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Hierarchy\AbstractDTO;
use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Nested\NumberNestedInFilmDTO;
use App\Component\DTO\Nested\PersonNestedDTO;
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
            ModelConstants::NUMBER_NESTED_IN_FILM_DTO_MODEL => new NumberNestedInFilmDTO(),

            ModelConstants::FILM_PAYLOAD_MODEL => new FilmPayloadDTO(),
            ModelConstants::FILM_NESTED_DTO_MODEL => new FilmNestedDTO(),

            ModelConstants::ATTRIBUTE_PAYLOAD_MODEL => new AttributePayloadDTO(),
            ModelConstants::ATTRIBUTE_NESTED_IN_CATEGORY_MODEL => new AttributeNestedDTO(),
            ModelConstants::CATEGORY_PAYLOAD_MODEL => new CategoryPayloadDTO(),

            ModelConstants::PERSON_PAYLOAD_MODEL => new PersonPayloadDTO(),
            ModelConstants::PERSON_NESTED_DTO_MODEL => new PersonNestedDTO(),

            ModelConstants::HOME_PAYLOAD_MODEL => new HomePayloadDTO(),
        ];

        foreach ($config as $configEntityName => $entity) {
            if ($entityName === $configEntityName) {
                return $entity;
            }
        }
    }
}