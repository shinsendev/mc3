<?php

declare(strict_types=1);


namespace App\Component\Stats\Computation;


use App\Component\DTO\Stats\Person\NestedFilmsInPersonStatsDTO;
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
    public static function computeAverageShotLength(string $personUuid, EntityManagerInterface $em):int
    {
        return intval(100*round($em->getRepository(Person::class)->computeAverageShotLength($personUuid),2));
    }

    /**
     * @return NestedFilmsInPersonStatsDTO[]
     */
    public static function generateFilmsStats(string $personUuid, EntityManagerInterface $em):array
    {
        // get all films by the numbers connected as performers to the person
        $films = $em->getRepository(Person::class)->findFilmsWherePerforming($personUuid);

        $filmsDTO = [];
        foreach ($films as $film) {
            $filmDTO = self::generateFilmDTO($film);
            $filmsDTO[] = $filmDTO;
        }

        return $filmsDTO;
    }

    /**
     * @param Film $film
     * @return NestedFilmsInPersonStatsDTO
     */
    private static function generateFilmDTO(Film $film):NestedFilmsInPersonStatsDTO
    {
        $filmDTO = new NestedFilmsInPersonStatsDTO();
        $filmDTO->setTitle($film->getTitle());
        $filmDTO->setImdb($film->getImdb());
        $filmDTO->setUUid($film->getUuid());

        dd($filmDTO);

        return $filmDTO;
    }
}