<?php


namespace App\Component\Stats\Definition;

use Doctrine\ORM\EntityManagerInterface;

interface StatsStrategyInteface
{
    static function saveStats(string $personUuid, EntityManagerInterface $em, $options = []):void;
}