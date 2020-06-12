<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
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
        $params['excludes'] = ['dubbing', 'film'];
        // fields we are forced to complete, if not we throw an error
        $params['mandatory'] = ['title'];

        $data['model'] = ModelConstants::NUMBER_MODEL;
        /** @var Number $number */
        $number = $data['number'];

        /** @var NumberPayloadDTO $dto */
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        // set film with nested object
//        $nestedFilm = DTOFactory::create(ModelConstants::FILM_NESTED_DTO_MODEL);
//        $nestedFilm = NestedFilmHydrator::hydrate($nestedFilm, ['film' => $number->getFilm()], $em);

        $attributeConfiguration = [
            [
                'initialProperty' => 'performance_thesaurus',
                'convertedProperty' => 'performance'
            ],
            [
                'initialProperty' => 'musician_thesaurus',
                'convertedProperty' => 'visibleMusicians'
            ],
            [
                'initialProperty' =>'begin_thesaurus',
                'convertedProperty' => 'beginning'
            ],
            [
                'initialProperty' => 'ending_thesaurus',
                'convertedProperty' => 'ending'
            ],
            [
                'initialProperty' => 'completeness_thesaurus',
                'convertedProperty' => 'completeness',
            ]
        ];



        // set film in a string
        $nestedFilm = $number->getFilm()->getTitle(). ' ('.$number->getFilm()->getReleasedYear().')';
        $dto->setFilm($nestedFilm);

        $manyToMany = ['completeness_thesaurus', 'dancemble', 'musensemble', 'source_thesaurus', 'imaginary', 'diegetic_place_thesaurus', 'exoticism_thesaurus', 'musical_thesaurus', 'tempo_thesaurus', 'quotation_thesaurus', 'dancing_type'];
        $dto = self::setAttributes($number->getAttributes(), $dto, $manyToMany);

//        $dto = AttributeHelper::setAttributes($number->getAttributes(), $attributeConfiguration, $dto);


        return $dto;
    }

    /**
     * @param PersistentCollection $attributes
     * @param DTOInterface $dto
     * @param array $manyToMany
     * @return NumberPayloadDTO
     */
    public function setAttributes(PersistentCollection $attributes, DTOInterface $dto, array $manyToMany = []):NumberPayloadDTO
    {
        foreach ($attributes as $attribute) {
            $code = $attribute->getCategory()->getCode();

            // handle exception
            if ($code === 'performance_thesaurus') {
                $dto->setPerformance($attribute->getTitle());
                continue;
            }

            if ($code === 'musician_thesaurus') {
                $dto->setVisibleMusicians($attribute->getTitle());
                continue;
            }

            if ($code === 'begin_thesaurus') {
                $dto->setBeginning($attribute->getTitle());
                continue;
            }

            if ($code === 'ending_thesaurus') {
                $dto->setEnding($attribute->getTitle());
                continue;
            }

            if ($code === 'spectators_thesaurus') {
                $dto->setSpectators($attribute->getTitle());
                continue;
            }

            if ($code === 'stereotype') { // topic?
                continue;
            }

            // handle many to many
            if (in_array($code, $manyToMany)) {
                if ($code === 'completeness_thesaurus') {
                    $manyToManyAttributes['completeness'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'dancemble') {
                    $manyToManyAttributes['danceEnsemble'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'musensemble') {
                    $manyToManyAttributes['musicalEnsemble'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'source_thesaurus') {
                    $manyToManyAttributes['source'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'imaginary') {
                    $manyToManyAttributes['imaginaryPlace'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'diegetic_place_thesaurus') {
                    $manyToManyAttributes['diegeticPlace'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'exoticism_thesaurus') {
                    $manyToManyAttributes['exoticism'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'musical_thesaurus') {
                    $manyToManyAttributes['musicalStyle'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'tempo_thesaurus') {
                    $manyToManyAttributes['tempo'][] = $attribute->getTitle();
                    continue;
                }

                if ($code === 'quotation_thesaurus') {
                    $manyToManyAttributes['quotation'][] = $attribute->getTitle();
                    continue;
                }

                $manyToManyAttributes[$code][] = $attribute->getTitle();
                continue;
            }

            // for all normal many to one
            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
            $dto->$setter($attribute->getTitle());

        }

        // for attributes again: set many to many
        foreach ($manyToMany as $category) {
            if ($category === 'completeness_thesaurus') {
                $dto->setCompleteness($manyToManyAttributes['completeness']);
            }

            if ($category === 'dancemble') {
                $dto->setDanceEnsemble($manyToManyAttributes['danceEnsemble']);
            }

            if ($category === 'musensemble') {
                $dto->setMusicalEnsemble($manyToManyAttributes['musicalEnsemble']);
            }

            if ($category === 'source_thesaurus') {
                $dto->setSource($manyToManyAttributes['source']);
            }

            if ($category === 'imaginary') {
                $dto->setImaginaryPlace($manyToManyAttributes['imaginaryPlace']);
            }

            if ($category === 'diegetic_place_thesaurus') {
                $dto->setDiegeticPlace($manyToManyAttributes['diegeticPlace']);
            }

            if ($category === 'exoticism_thesaurus') {
                $dto->setExoticism($manyToManyAttributes['exoticism']);
            }

            if ($category === 'musical_thesaurus') {
                $dto->setMusicalStyles($manyToManyAttributes['musicalStyle']);
            }

            if ($category === 'tempo_thesaurus') {
                $dto->setTempo($manyToManyAttributes['tempo']);
            }

            if ($category === 'quotation_thesaurus') {
                $dto->setQuotation($manyToManyAttributes['quotation']);
            }

            if ($category === 'dancing_type') {
                $dto->setDancingType($manyToManyAttributes['dancing_type']);
            }
        }

        return $dto;
    }

}