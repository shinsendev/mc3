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

        // set film in a string
        $nestedFilm = $number->getFilm()->getTitle(). ' ('.$number->getFilm()->getReleasedYear().')';
        $dto->setFilm($nestedFilm);

        // set all attributes connected to a number
        $dto = self::setAttributes($number->getAttributes(), $dto);

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

    /**
     * @param PersistentCollection $songs
     * @param NumberPayloadDTO $dto
     * @param EntityManagerInterface $em
     * @return NumberPayloadDTO
     */
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
     * @param NumberPayloadDTO $dto
     * @return NumberPayloadDTO
     */
    public static function setAttributes(PersistentCollection $attributes, DTOInterface $dto):NumberPayloadDTO
    {
        // todo : treat directly in importer ?
        // legacy = old MC2 thesaurus name and actual name in database, if we change them inside the MC3 importer, we don't need it anymore
        // handle many to one exception
        $manyToManyConfiguration = [
            [
                'legacy' => 'completeness_thesaurus',
                'current' => 'completeness'
            ],
            [
                'legacy' => 'source_thesaurus',
                'current' => 'sources'
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
                'legacy' => 'dance_subgenre',
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
            ]
        ];

        // prepare an array to collect all results for attributes
        $manyToManyAttributes = [];

        // we add each attribute to the number payload :
        // 1) as a many to one exception if it's simply a string
        // 2) as a many to many, if it's a list
        // 3) as a simple string
        foreach ($attributes as $index => $attribute) {
            $code = $attribute->getCategory()->getCode();

            // 1) manage simple attributes
            if (AttributeManyToOneHydrator::setManyToOneThesaurus($code, $attribute, $dto, $manyToOneExceptions)) {
                $dto = AttributeManyToOneHydrator::setManyToOneThesaurus($code, $attribute, $dto, $manyToOneExceptions);
                unset($attributes[$index]);
                continue;
            }

            // 2) handle many to many and get list
            foreach ($manyToManyConfiguration as $manyToManyCode) {
                if ($code === $manyToManyCode['legacy']) {
                    $manyToManyAttributes = AttributeManyToManyHydrator::addOneManyToManyAttribute($manyToManyCode['current'], $attribute, $manyToManyAttributes);
                    unset($attributes[$index]);
                }
            }
        }

        // 3) we reloop for all normal many to one
        foreach ($attributes as $index => $attribute) {
            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
            $dto->$setter($attribute->getTitle());
        }

        // after getting all many to many attributes for all properties in the $manyToManyAttributes array, we hydrate each properties of the dto
        if (isset($manyToManyAttributes)) {
            $dto = AttributeManyToManyHydrator::setAllManyToManyAttributes($manyToManyAttributes, $dto, $manyToManyConfiguration);
        }

        return $dto;
    }

}