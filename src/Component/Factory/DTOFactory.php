<?php

declare(strict_types=1);


namespace App\Component\Factory;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Elastic\ElasticIndexationDTO;
use App\Component\DTO\Export\CsvExportDTO;
use App\Component\DTO\Nested\AttributeNestedDTO;
use App\Component\DTO\Nested\AttributeNestedDTOinCategory;
use App\Component\DTO\Nested\CoworkerNestedDTO;
use App\Component\DTO\Nested\Elastic\ElasticFilmNestedDTO;
use App\Component\DTO\Nested\Elastic\ElasticSongNestedDTO;
use App\Component\DTO\Nested\ElementNestedDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Nested\FilmNestedInPersonDTO;
use App\Component\DTO\Nested\NumberNestedInFilmDTO;
use App\Component\DTO\Nested\NumberNestedInPersonDTO;
use App\Component\DTO\Nested\PersonNestedDTO;
use App\Component\DTO\Nested\PersonNestedInPersonDTO;
use App\Component\DTO\Nested\SongNestedDTO;
use App\Component\DTO\Payload\AttributePayloadDTO;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\HomePayloadDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Component\DTO\Stats\Person\NestedComparisonsDTO;
use App\Component\Exporter\Strategy\CsvExportStrategy;
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
            ModelConstants::SONG_NESTED_MODEL => new SongNestedDTO(),

            ModelConstants::NUMBER_PAYLOAD_MODEL => new NumberPayloadDTO(),
            ModelConstants::NUMBER_NESTED_IN_FILM_DTO_MODEL => new NumberNestedInFilmDTO(),
            ModelConstants::NUMBER_NESTED_IN_PERSON_DTO_MODEL => new NumberNestedInPersonDTO(),

            ModelConstants::FILM_PAYLOAD_MODEL => new FilmPayloadDTO(),
            ModelConstants::FILM_NESTED_DTO_MODEL => new FilmNestedDTO(),

            ModelConstants::ATTRIBUTE_PAYLOAD_MODEL => new AttributePayloadDTO(),
            ModelConstants::ATTRIBUTE_NESTED_IN_CATEGORY_MODEL => new AttributeNestedDTOinCategory(),
            ModelConstants::CATEGORY_PAYLOAD_MODEL => new CategoryPayloadDTO(),
            ModelConstants::ATTRIBUTE_NESTED_PAYLOAD => new AttributeNestedDTO(),

            ModelConstants::ELEMENT_NESTED_DTO_MODEL=> new ElementNestedDTO(),

            ModelConstants::PERSON_PAYLOAD_MODEL => new PersonPayloadDTO(),
            ModelConstants::PERSON_NESTED_DTO_MODEL => new PersonNestedDTO(),
            ModelConstants::PERSON_NESTED_IN_PERSON_DTO_MODEL => new PersonNestedInPersonDTO(),
            ModelConstants::PERSON_COWORKER => new CoworkerNestedDTO(),

            ModelConstants::EXPORT_CSV_DTO => new CsvExportDTO(),

            ModelConstants::ELASTIC_NUMBER_DTO => new ElasticIndexationDTO(),
            ModelConstants::ELASTIC_NESTED_FILM_DTO => new ElasticFilmNestedDTO(),
            ModelConstants::ELASTIC_NESTED_SONG_DTO => new ElasticSongNestedDTO(),

            ModelConstants::HOME_PAYLOAD_MODEL => new HomePayloadDTO(),

            ModelConstants::COMPARISON_STATS => new NestedComparisonsDTO(),
        ];

        foreach ($config as $configEntityName => $entity) {
            if ($entityName === $configEntityName) {
                return $entity;
            }
        }
    }
}