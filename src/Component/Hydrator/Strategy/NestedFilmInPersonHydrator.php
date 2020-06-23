<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\FilmNestedInPersonDTO;
use App\Component\Hydrator\Description\HydratorInterface;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class NestedFilmInPersonHydrator implements HydratorInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Film $film */
        $film = $data['film'];

        /** @var FilmNestedInPersonDTO $dto */
        $dto->setTitle($film->getTitle());
        $dto->setUuid($film->getUuid());

        if ($film->getReleasedYear()) {
            $dto->setReleasedYear($film->getReleasedYear());
        }

        $totalNumberLength = $em->getRepository(Film::class)->computeNumbersLength();
        dd($totalNumberLength);
//        $totalNumberLengthByPerson = $em->getRepository(Film::class)->computeNumbersLengthByPerson();

        return $dto;
    }
}
