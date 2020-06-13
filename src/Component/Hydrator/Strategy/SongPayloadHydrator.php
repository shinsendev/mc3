<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\AttributeNestedDTOinCategory;
use App\Component\DTO\Nested\NumberNestedDTO;
use App\Component\DTO\Nested\NumberNestedInFilmDTO;
use App\Component\DTO\Nested\PersonNestedDTO;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Helper\PersonHelper;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Song;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class SongPayloadHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return SongPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):SongPayloadDTO
    {
        /** @var Song $song */
        $song = $data['song'];

        /** @var SongPayloadDTO $dto */
        $dto->setTitle($song->getTitle());

        if ($song->getYear()){
            $dto->setYear($song->getYear());
        }

        if ($song->getExternalId()){
            $dto->setExternalId($song->getExternalId());
        }

        $dto->setExternalId($song->getExternalId());
        $dto->setUuid($song->getUuid());

        // get song type, song have only one attribute (songtype), that's why we don't need to filter
        foreach ($data['song']->getAttributes() as $attribute) {
            $nestedAttributeDTO = DTOFactory::create(ModelConstants::ATTRIBUTE_NESTED_PAYLOAD);
            NestedAttribute::hydrate($nestedAttributeDTO, ['attribute' => $attribute], $em);
            $attributesDTO[] = $nestedAttributeDTO;
        }

        if (isset($attributesDTO) && count($attributesDTO) > 0) {
            $dto->setSongTypes($attributesDTO);
        }

        // get nested numbers
        foreach ($song->getNumbers() as $number) {
            $nestedNumberDTO = new NumberNestedDTO();
            $nestedNumberDTO->hydrate(['number' => $number], $em);
            $nestedNumbersListDTO[] = $nestedNumberDTO;
        }

        if (isset($nestedNumbersListDTO)) {
            $dto->setNumbers($nestedNumbersListDTO);
        }

        // get nested films (films deduced by numbers linked to song)
        $query = $em->getRepository(Song::class)->getFilmsQuery($song->getUuid());
        $films = new Paginator($query, $fetchJoinCollection = true);

        foreach($films as $film) {
            $filmPayload = DTOFactory::create(ModelConstants::FILM_NESTED_DTO_MODEL);
            $filmPayload = NestedFilmHydrator::hydrate($filmPayload, ['film' => $film], $em);
            $nestedFilmsListDTO[] = $filmPayload;
        }

        if (isset($nestedFilmsListDTO)) {
            $dto->setFilms($nestedFilmsListDTO);
        }

        // get lyricists
        $persons = $em->getRepository(Work::class)->findPersonByTargetAndProfession(ModelConstants::SONG_MODEL, $song->getUuid(), 'lyricist');
        foreach ($persons as $person) {
            /** @var PersonNestedDTO $personPayload */
            $nestedPersonDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $lyricists[] = NestedPersonPayloadHydrator::hydrate($nestedPersonDTO, ['person' => $person], $em);
        }

        if (isset($lyricists)) {
            $dto->setLyricists($lyricists);
        }

        // get composers
        $persons = $em->getRepository(Work::class)->findPersonByTargetAndProfession(ModelConstants::SONG_MODEL, $song->getUuid(), 'composer');
        foreach ($persons as $person) {
            /** @var PersonNestedDTO $personPayload */
            $nestedPersonDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $composers[] = NestedPersonPayloadHydrator::hydrate($nestedPersonDTO, ['person' => $person], $em);
        }

        if (isset($composers)) {
            $dto->setComposers($composers);
        }

        return $dto;
    }

}