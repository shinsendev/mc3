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
        //todo : round value
        return $em->getRepository(Person::class)->computeAverageShotLength($personUuid);
    }
}