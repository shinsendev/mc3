<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\NumberNestedInPersonDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Entity\Number;
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
        // not used for the moment, to remove if we never find a solution with doctrine
        if ($data['number'] instanceof Number) {
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
        }

        // because we don't use doctrine here
        else if (getType($data['number']) === 'array') {
            $number = $data['number'];

            $dto->setTitle($number['title']);
            $dto->setUuid($number['uuid']);
            $dto->setFilmTitle($number['film_title']);
            $dto->setFilmImdb($number['film_imdb']);
            $dto->setFilmUuid($number['film_uuid']);
            $dto->setFilmReleasedYear($number['film_released_year']);
            $dto->addProfession($number['profession']);
        }

        return $dto;
    }
}