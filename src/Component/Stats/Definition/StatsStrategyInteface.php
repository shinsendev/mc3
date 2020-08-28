<?php


namespace App\Component\Stats\Definition;


use App\Component\DTO\Stats\Person\PersonStatsDTO;
use Doctrine\ORM\EntityManagerInterface;

interface StatsStrategyInteface
{
    static function saveStats(string $personUuid, EntityManagerInterface $em):void;
    static function computeStats(string $personUuid, EntityManagerInterface $em):PersonStatsDTO;
}