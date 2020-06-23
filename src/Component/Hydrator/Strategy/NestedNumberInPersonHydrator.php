<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\NumberNestedInPersonDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use Doctrine\ORM\EntityManagerInterface;

class NestedNumberInPersonHydrator implements HydratorDTOInterface
{
    /**
     * @param NumberNestedInPersonDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        /** @var Number $number */
        $number = $data['number'];
        $profession = $data['profession'];

        $dto->setTitle($number->getTitle());
        $dto->setUuid($number->getUuid());

        $dto->setFilmTitle($number->getFilm()->getTitle());
        $dto->setFilmImdb($number->getFilm()->getImdb());
        $dto->setFilmUuid($number->getFilm()->getUuid());
        $dto->setFilmReleasedYear($number->getFilm()->getReleasedYear());

        $dto->addProfession($profession);

        return $dto;
    }
}