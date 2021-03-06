<?php

declare(strict_types=1);


namespace App\Component\Stats;


use App\Component\Error\Mc3Error;
use App\Component\Stats\Strategy\AttributeStatsStrategy;
use App\Component\Stats\Strategy\PersonStatsStrategy;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StatsGenerator
 * @package App\Component\Stats
 */
class StatsGenerator
{
    const PERSON_STRATEGY = 'personStrategy';
    const ATTRIBUTE_STRATEGY = 'attributeStrategy';

    /**
     * @param string $strategy
     * @param string $itemUuid
     * @param EntityManagerInterface $em
     * @param array $options
     */
    public static function generate(
        string $strategy,
        string $itemUuid,
        EntityManagerInterface $em,
        array $options = []
    ):void
    {
        if ($strategy === self::PERSON_STRATEGY) {
            PersonStatsStrategy::saveStats($itemUuid, $em, $options);
        }

        else if($strategy === self::ATTRIBUTE_STRATEGY) {
            AttributeStatsStrategy::saveStats($itemUuid, $em, $options);
        }

        else {
            throw new Mc3Error('Not a vaild strategy for generating stats');
        }
    }
}