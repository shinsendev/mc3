<?php


namespace App\Component\Hydrator\Strategy\Elastic;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\PersonNestedDTO;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\NestedAttribute;
use App\Component\Hydrator\Strategy\NestedPersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Song;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class ElasticNestedSongHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Song $song */
        $song = $data['song'];

        /** @var SongPayloadDTO $dto */
        $dto->setTitle($song->getTitle());

        if ($song->getYear()){
            $dto->setYear($song->getYear());
        }

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