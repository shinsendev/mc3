<?php

declare(strict_types=1);


namespace App\Component\Model;


class ModelConstants
{
    const ATTRIBUTE_MODEL = 'attribute';
    const ATTRIBUTE_PAYLOAD_MODEL = 'attributePayload';
    const ATTRIBUTE_NESTED_IN_CATEGORY_MODEL = 'attributeNestedInCategoryPayload';
    const ATTRIBUTE_NESTED_PAYLOAD = 'attributeNestedPayload';

    const CATEGORY_MODEL = 'category';
    const CATEGORY_PAYLOAD_MODEL = 'categoryPayload';

    const NUMBER_MODEL = 'number';
    const NUMBER_PAYLOAD_MODEL = 'numberPayload';
    const NUMBER_NESTED_IN_FILM_DTO_MODEL = 'numberNestedInFilmDTO';
    const NUMBER_NESTED_IN_PERSON_DTO_MODEL = 'numberNestedInPersonDTO';

    const FILM_MODEL = 'film';
    const FILM_NESTED_DTO_MODEL = 'filmNestedDTOModel';
    const FILM_PAYLOAD_MODEL = 'filmPayload';

    const SONG_MODEL = 'song';
    const SONG_PAYLOAD_MODEL = 'songPayload';
    const SONG_NESTED_MODEL = 'songNestedPayload';

    const PERSON_MODEL = 'person';
    const PERSON_PAYLOAD_MODEL = 'personPayload';
    const PERSON_NESTED_DTO_MODEL = 'personNestedDTOModel';
    const PERSON_NESTED_IN_PERSON_DTO_MODEL = 'personNestedInPersonDTO';
    const PERSON_COWORKER='coworkerNestedDTO';

    const EXPORT_CSV_DTO ='csvExportDTO';

    const ELASTIC_NUMBER_DTO = 'ElasticNumberDTO';

    const COMPARISON_STATS = 'comparisonStats';

    const ELEMENT_NESTED_DTO_MODEL = 'elementNestedDTOModel';

    const HOME_PAYLOAD_MODEL='home';

    const NO_DATA= 'no value';
}