<?php

declare(strict_types=1);


namespace App\Component\Stats\Computation;


use App\Component\DTO\Stats\Person\NestedFilmsInPersonStatsDTO;
use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Person;
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

        // get generic stats
        foreach ($types as $type) {
            self::generateComparisonByType($type);
        }

        // todo : format result

        return null;
    }

    /**
     * @param string $type
     * @return null
     */
    private static function generateComparisonByType(string $type)
    {
        // todo: create a dto
        dd('return a dto');
        // current, target, codeUuid, codeTitle
        return null;
    }
}