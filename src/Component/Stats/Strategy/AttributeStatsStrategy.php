<?php


namespace App\Component\Stats\Strategy;


use App\Component\DTO\Stats\Person\PersonStatsDTO;
use App\Component\Stats\Definition\StatsStrategyInteface;
use Doctrine\ORM\EntityManagerInterface;

class AttributeStatsStrategy implements StatsStrategyInteface
{
    static function saveStats(string $personUuid, EntityManagerInterface $em): void
    {
        dd('ici');
        // TODO: Implement saveStats() method.
    }

    static function computeStats(string $personUuid, EntityManagerInterface $em): PersonStatsDTO
    {
        // TODO: Implement computeStats() method.
    }

}