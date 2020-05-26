<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Description;

use App\Component\DTO\Definition\DTOInterface;
use Doctrine\ORM\EntityManagerInterface;

interface HydratorDTOInterface extends HydratorInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em);

}