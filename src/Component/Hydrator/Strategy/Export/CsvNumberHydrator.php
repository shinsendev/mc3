<?php

namespace App\Component\Hydrator\Strategy\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Strategy\HydratorStrategyInterface;
use Doctrine\ORM\EntityManagerInterface;

class CsvNumberHydrator implements HydratorStrategyInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em): DTOInterface
    {
        // TODO: Implement hydrate() method.
    }

}