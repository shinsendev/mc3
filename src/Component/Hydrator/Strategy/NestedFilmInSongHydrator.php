<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Hydrator\Description\HydratorInterface;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class NestedFilmInSongHydrator implements HydratorInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return FilmPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):FilmPayloadDTO
    {
        /** @var Film $film */
        $film = $data['film'];

        /** @var FilmPayloadDTO $dto */
        $dto->setTitle($film['title']);
        $dto->setUuid($film['uuid']);
        $dto->setImdb($film['imdb']);
        if (isset($data['released'])) {
            $dto->setReleased($data['released']);
        }

        return $dto;

    }
}