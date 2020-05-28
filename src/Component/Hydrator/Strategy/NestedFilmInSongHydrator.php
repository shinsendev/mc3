<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\Hydrator\Description\HydratorInterface;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class NestedFilmInSongHydrator implements HydratorInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface|FilmNestedDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em)
    {
        /** @var Film $film */
        $film = $data['film'];

        /** @var FilmNestedDTO $dto */
        $dto->setTitle($film->getTitle());
        $dto->setUuid($film->getUuid());
        $dto->setImdb($film->getImdb());
        if ($film->getReleasedYear()) {
            $dto->setReleasedYear($film->getReleasedYear());
        }

        return $dto;
    }
}
