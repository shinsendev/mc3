<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Interface HydratorStrategyInterface
 * @package App\Component\Hydrator\Strategy
 */
interface HydratorStrategyInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface;
}