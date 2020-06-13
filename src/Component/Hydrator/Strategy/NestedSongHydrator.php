<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use Doctrine\ORM\EntityManagerInterface;

class NestedSongHydrator implements HydratorStrategyInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        $song = $data['song'];

        $dto->setTitle($song->getTitle());
        $dto->setUuid($song->getUuid());

        if($song->getYear()) {
            $dto->setYear($song->getYear());
        }

        return $dto;
    }
}