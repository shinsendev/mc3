<?php

declare(strict_types=1);


namespace App\Component\Stats\Computation;


use App\Component\DTO\Stats\Person\NestedFilmsInPersonStatsDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Person;
use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;

class ComputePersonStats
{
    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return int
     */
    public static function computeAverageShotLength(string $personUuid, EntityManagerInterface $em):?int
    {
        return intval(100*round($em->getRepository(Person::class)->computeAverageShotLength($personUuid),2));
    }

    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return array
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public static function generateFilmsStats(string $personUuid, EntityManagerInterface $em):array
    {
        // get all films by the numbers connected as performers to the person
        if ($films = $em->getRepository(Person::class)->findFilmsWherePerforming($personUuid)) {
            $filmsDTO = [];
            foreach ($films as $film) {
                $filmDTO = self::generateFilmDTO($film, $personUuid, $em);
                $filmsDTO[] = $filmDTO;
            }

            return $filmsDTO;
        }

        return [];
    }

    /**
     * @param Film $film
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return NestedFilmsInPersonStatsDTO
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    private static function generateFilmDTO(Film $film, string $personUuid, EntityManagerInterface $em):NestedFilmsInPersonStatsDTO
    {
        $filmUuid = $film->getUuid();

        $filmDTO = new NestedFilmsInPersonStatsDTO();
        $filmDTO->setTitle($film->getTitle());
        $filmDTO->setImdb($film->getImdb());
        $filmDTO->setUUid($film->getUuid());
        $filmDTO->setReleasedYear($film->getReleasedYear());

        // $totalNumbersLength
        $totalNumbersLength = $em->getRepository(Film::class)->computeNumbersLength($filmUuid);
        $filmDTO->setTotalNumbersLength($totalNumbersLength);

        // $totalPersonNumbersLength
        $totalPersonNumbersLength = $em->getRepository(Film::class)->computeNumbersLengthForPerson($filmUuid, $personUuid);
        $filmDTO->setTotalPersonNumbersLength($totalPersonNumbersLength);

        return $filmDTO;
    }

    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return null
     */
    public static function generateComparisonsStats(string $personUuid, EntityManagerInterface $em)
    {
        $types = [Category::PERFORMANCE_TYPE, Category::STRUCTURE_TYPE, Category::COMPLETENESS_TYPE, Category::SOURCE_TYPE, Category::DIEGETIC_TYPE ];

        $comparisonsByType= [];

        // get generic stats
        foreach ($types as $type) {
            $comparisonsByType[] = self::generateComparisonByType($type, $personUuid, $em);
        }

        return $comparisonsByType;
    }

    /**
     * @param string $type
     * @param EntityManagerInterface $em
     * @return null
     */
    private static function generateComparisonByType(string $type, string $personUuid, EntityManagerInterface $em)
    {
        $attributeThesaurus = $em->getRepository(Attribute::class);
        $averageData = $attributeThesaurus->computeAveragesForType($type);
        $currentData = $attributeThesaurus->computeAveragesForTypeAndPerson($type, $personUuid);

        $totalAverage = 0;
        foreach ($averageData as $data) {
            $totalAverage += $data['average'];
        }
        if ($totalAverage) {
            $totalAverage = 100/$totalAverage;
        }

        $totalCurrent = 0;
        foreach ($currentData as $data) {
            $totalCurrent += $data['current'];
        }
        if ($totalCurrent) {
            $totalCurrent = 100/$totalCurrent;
        }

        // format result
        $comparisons = [];

        // if there is no totalCurrent, it means we don't need to create stats because there is no data
        if ($totalCurrent) {
            // first get average data
            foreach ($averageData as $data) {
                $comparisonDTO = DTOFactory::create(ModelConstants::COMPARISON_STATS);
                $comparisonDTO->setCurrent(self::getCurrentData($data['uuid'], $currentData, $totalCurrent));
                $comparisonDTO->setAverage(intval(round($totalAverage*$data['average'], 2)*100));
                $comparisonDTO->setCategoryUuid($data['categoryUuid']);
                $comparisonDTO->setCategoryCode(self::convertCode($type));
                $comparisonDTO->setAttributeTitle($data['title']);
                $comparisonDTO->setAttributeUuid($data['uuid']);
                $comparisons[] = $comparisonDTO;
            }
        }
        return $comparisons;
    }

    /**
     * @param string $attributeUuid
     * @param array $currentDataList
     * @param int $totalCurrent
     * @return int
     */
    private static function getCurrentData(string $attributeUuid, array $currentDataList, float $totalCurrent):int
    {
        // by default, we set to 0 the count of an attribute for a person
        $result = 0;

        foreach ($currentDataList as $current) {
            if ($current['uuid'] === $attributeUuid) {
                return (intval(round($totalCurrent*$current['current'], 2)*100));
            }
        }

        return $result;
    }

    /**
     * @param string $type
     * @return string
     */
    private static function convertCode(string $type):string
    {
        $result = 'default';

        $adaptater = [
            ["raw" => "structure", "computed"=> "structure"],
            ["raw" => "performance_thesaurus", "computed"=> "performance"],
            ["raw" => "source_thesaurus", "computed"=> "source"],
            ["raw" => "completeness_thesaurus", "computed"=> "completeness"],
            ["raw" => "diegetic_thesaurus", "computed"=> "diegetic"],
            ["raw" => "cast", "computed"=> "cast"],
        ];

        foreach ($adaptater as $code) {
            if ($code['raw'] === $type) {
                return $code['computed'];
            }
        }

        return $result;
    }
}