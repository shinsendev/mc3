<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Attribute\AttributeManyToManyHydrator;
use App\Component\Hydrator\Attribute\AttributeManyToOneHydrator;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Helper\PersonHelper;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;

class NumberPayloadHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return NumberPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):NumberPayloadDTO
    {
        $params = [];
        // set excludes parameters to treate manually some properties
        $params['excludes'] = ['dubbing', 'film', 'songs'];
        // fields we are forced to complete, if not we throw an error
        $params['mandatory'] = ['title'];

        $data['model'] = ModelConstants::NUMBER_MODEL;
        /** @var Number $number */
        $number = $data['number'];

        /** @var NumberPayloadDTO $dto */
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        // set timecode
        $dto->setStartingTc($number->getBeginTc());
        $dto->setEndingTc($number->getEndTc());

        foreach($number->getAttributes() as $attribute) {
            $attributesList[] = $attribute->getCategory()->getCode();
        }

        // set film in a string
        $nestedFilm = $number->getFilm()->getTitle(). ' ('.$number->getFilm()->getReleasedYear().')';
        $dto->setFilm($nestedFilm);

        $manyToMany = ['completeness_thesaurus', 'dancemble', 'dance_subgenre', 'musensemble', 'source_thesaurus', 'imaginary', 'diegetic_place_thesaurus', 'exoticism_thesaurus', 'musical_thesaurus', 'tempo_thesaurus', 'quotation_thesaurus', 'dancing_type', 'stereotype', 'genre', 'dance_content'];
        $dto = self::setAttributes($number->getAttributes(), $dto, $manyToMany);

        // add persons
        $performers = PersonHelper::getPersonsByProfession('performer', ModelConstants::NUMBER_MODEL, $number, $em);
        $dto->setPerformers($performers);

        $arrangers = PersonHelper::getPersonsByProfession('arranger', ModelConstants::NUMBER_MODEL, $number, $em);
        $dto->setArrangers($arrangers);

        $danceDirectors = PersonHelper::getPersonsByProfession('choregraph', ModelConstants::NUMBER_MODEL, $number, $em);
        $dto->setDanceDirectors($danceDirectors);

        $directors = PersonHelper::getPersonsByProfession('director', ModelConstants::NUMBER_MODEL, $number, $em);
        $dto->setDirectors($directors);

        // add songs
        $dto = self::setSongs($number->getSongs(), $dto, $em);

        return $dto;
    }

    public static function setSongs(PersistentCollection $songs, NumberPayloadDTO $dto, EntityManagerInterface $em):NumberPayloadDTO
    {
        $songsDTO = [];
        foreach($songs as $song) {
            $songDTO = DTOFactory::create(ModelConstants::SONG_NESTED_MODEL);
            $songsDTO[] = NestedSongHydrator::hydrate($songDTO, ['song' => $song], $em);
        }
        $dto->setSongs($songsDTO);

        return $dto;
    }

    /**
     * @param PersistentCollection $attributes
     * @param DTOInterface $dto
     * @param array $manyToMany
     * @return NumberPayloadDTO
     */
    public static function setAttributes(PersistentCollection $attributes, DTOInterface $dto, array $manyToMany = []):NumberPayloadDTO
    {
        $manyToManyAttributes = [];

        foreach ($attributes as $attribute) {
            $code = $attribute->getCategory()->getCode();

            $manyToOneExceptions = [
                [
                    'legacy' => 'performance_thesaurus',
                    'current' => 'performance'
                ],
                [
                    'legacy' => 'musician_thesaurus',
                    'current' => 'visibleMusicians'
                ],
                [
                    'legacy' => 'begin_thesaurus',
                    'current' => 'beginning'
                ],
                [
                    'legacy' => 'ending_thesaurus',
                    'current' => 'ending'
                ],
                [
                    'legacy' => 'spectators_thesaurus',
                    'current' => 'spectators'
                ],
                [
                    'legacy' => 'complet_options',
                    'current' => 'completenessOption'
                ],
            ];

            // handle many to one exception
            if (AttributeManyToOneHydrator::setManyToOneThesaurus($code, $attribute, $dto, $manyToOneExceptions)) {
                $dto = AttributeManyToOneHydrator::setManyToOneThesaurus($code, $attribute, $dto, $manyToOneExceptions);
                continue;
            }

            // handle many to many
            if (in_array($code, $manyToMany)) {
                if ($result = AttributeManyToManyHydrator::prepareManyToMany($code, $attribute)) {
                    $manyToManyAttributes = array_merge($manyToManyAttributes, $result);
                    continue;
                }

                $manyToManyAttributes[$code][] = $attribute->getTitle();
            }

            // for all normal many to one
            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
            $dto->$setter($attribute->getTitle());
        }


        $manyToManyConfiguration = [
            [
                'legacy' => 'completeness_thesaurus',
                'current' => 'completeness'
            ],
            [
                'legacy' => 'dancemble',
                'current' => 'danceEnsemble'
            ],
            [
                'legacy' => 'musensemble',
                'current' => 'musicalEnsemble'
            ],
            [
                'legacy' => 'imaginary',
                'current' => 'imaginaryPlace'
            ],
            [
                'legacy' => 'diegetic_place_thesaurus',
                'current' => 'diegeticPlace'
            ],
            [
                'legacy' => 'exoticism_thesaurus',
                'current' => 'exoticism'
            ],
            [
                'legacy' => 'musical_thesaurus',
                'current' => 'musicalStyles'
            ],
            [
                'legacy' => 'tempo_thesaurus',
                'current' => 'tempo'
            ],
            [
                'legacy' => 'quotation_thesaurus',
                'current' => 'quotation'
            ],
            [
                'legacy' => 'dancing_type',
                'current' => 'dancingType'
            ],
            [
                'legacy' => 'stereotype',
                'current' => 'ethnicStereotypes'
            ],
            [
                'legacy' => 'danceSubgenre',
                'current' => 'danceSubgenre'
            ],
            [
                'legacy' => 'genre',
                'current' => 'topic'
            ],
            [
                'legacy' => 'dance_content',
                'current' => 'danceContent'
            ],
        ];


        if (isset($manyToManyAttributes)) {
            $dto = AttributeManyToManyHydrator::setAllManyToManyAttributes($manyToManyAttributes, $manyToMany, $dto, $manyToManyConfiguration);
        }

        return $dto;
    }

}