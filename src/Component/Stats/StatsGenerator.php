<?php

declare(strict_types=1);


namespace App\Component\Stats;


use App\Component\Stats\Strategy\PersonStatsStrategy;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StatsGenerator
 * @package App\Component\Stats
 */
class StatsGenerator
{
    const PERSON_STRATEGY = 'personStrategy';

    /**
     * @param string $strategy
     * @param string $itemUuid
     * @param EntityManagerInterface $em
     */
    public static function generate(
        string $strategy,
        string $itemUuid,
        EntityManagerInterface $em
    ):void
    {
        if ($strategy === self::PERSON_STRATEGY) {
            PersonStatsStrategy::saveStats($itemUuid, $em);
        }
    }
}