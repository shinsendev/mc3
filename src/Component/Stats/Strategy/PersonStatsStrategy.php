<?php

declare(strict_types=1);

namespace App\Component\Stats\Strategy;

use App\Component\DTO\Stats\Person\PersonStatsDTO;
use App\Component\Model\ModelConstants;
use App\Component\Stats\Computation\ComputePersonStats;
use App\Entity\Statistic;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
        if (!$stat = $em->getRepository(Statistic::class)->findOneBy(['targetUuid' => $personUuid, 'key' => self::PERSON_STATS_KEY])) {
            $stat = new Statistic();
            $stat->setKey(self::PERSON_STATS_KEY);
            $stat->setTargetUuid($personUuid);
            $stat->setModel(ModelConstants::PERSON_MODEL);
        }

        /** @var PersonStatsDTO $personStatsDTO */
        $personStatsDTO = self::computeStats($personUuid, $em);

        // convert PersonStatsDTO into array
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);
        $stat->setValue($serializer->normalize($personStatsDTO));

        $em->persist($stat);
        $em->flush();
    }

    /**
     * @param string $personUuid
     * @param EntityManagerInterface $em
     * @return PersonStatsDTO[]|array
     */
    private function computeStats(string $personUuid, EntityManagerInterface $em):PersonStatsDTO
    {
        $personStats = new PersonStatsDTO(); // to serialise in json array
        $personStats->setAverageShotLength(ComputePersonStats::computeAverageShotLength($personUuid, $em));

        $films = ComputePersonStats::generateFilmStats();
        $personStats->setFilms([$films]);

        return $personStats;
    }
}