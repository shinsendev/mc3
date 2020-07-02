<?php

declare(strict_types=1);


namespace App\Component\Stats\Computation;


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
}