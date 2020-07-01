<?php

declare(strict_types=1);


namespace App\Component\Stats;


use App\Component\Stats\Strategy\PersonStatsStrategy;

/**
 * Class StatsGenerator
 * @package App\Component\Stats
 */
class StatsGenerator
{
    const PERSON_STRATEGY = 'personStrategy';

    public static function generate(string $strategy, string $itemUuid):void
    {
        if ($strategy === self::PERSON_STRATEGY) {
            PersonStatsStrategy::saveStats($itemUuid);
        }
    }
}