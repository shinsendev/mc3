<?php

declare(strict_types=1);

namespace App\Component\Stats\Strategy;

use App\Component\DTO\Stats\Person\PersonStatsDTO;
use App\Component\Model\ModelConstants;
use App\Component\Stats\Computation\ComputePersonStats;
use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PersonStatsStrategy
 * @package App\Component\Stats\Strategy
 */
class PersonStatsStrategy
{
    const PERSON_STATS_KEY = 'personStats';

    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     */
    public static function saveStats(string $personUuid, EntityManagerInterface $em):void
    {
        // if stat already exists, it's an update, if not we create a new stat
        if (!$stat = $em->getRepository(Statistic::class)->findBy(['targetUuid' => $personUuid, 'key' => self::PERSON_STATS_KEY])) {
            $stat = new Statistic();
            $stat->setKey(self::PERSON_STATS_KEY);
            $stat->setTargetUuid($personUuid);
            $stat->setModel(ModelConstants::PERSON_MODEL);
        }

        $computeStats = self::computeStats($personUuid, $em);
        $stat->setValue($computeStats);
        $em->persist($stat);
        $em->flush();
    }

    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return PersonStatsDTO[]|array
     */
    private function computeStats(string $personUuid, EntityManagerInterface $em): array
    {
        $personStats = new PersonStatsDTO(); // to serialise in json array
        $personStats->setAverageShotLength(ComputePersonStats::computeAverageShotLength($personUuid, $em));
        dd($personStats);

        $films = [];
        $stat->setFilms([$films]);

        return [$stat];
    }
}