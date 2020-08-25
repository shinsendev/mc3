<?php

namespace App\Component\Hydrator\Strategy\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CsvExportDTO;
use App\Component\Hydrator\Strategy\HydratorStrategyInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class CsvFilmHydrator implements HydratorStrategyInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):CsvExportDTO
    {
        $film = $data['film'];
        $filmAttributes = $film->getAttributes();

        // film general
        $dto->setFilmTitle($film->getTitle());
        $dto->setFilmReleased($film->getReleasedYear());
        $dto->setFilmSample($film->getSample());

        $dto->setFilmDirectors(self::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $film->getUuid(), Person::DIRECTOR_PROFESSION));

        if (count($film->getStudios()) > 0) {
            $dto->setFilmStudios(self::getStudios($film->getStudios()));
        }
        $dto->setFilmUuid($film->getuuid());
        $dto->setFilmImdb($film->getImdb());
        $dto->setFilmShows($film->getStageshows());
        $dto->setFilmRemake($film->getRemake());
        $dto->setFilmPca($film->getPca());
        $dto->setFilmCensorships(self::getAttributesByCategoryCode($filmAttributes, 'censorship'));
        $dto->setFilmStates(self::getAttributesByCategoryCode($filmAttributes, 'state'));
        $dto->setFilmLegion(self::getAttributesByCategoryCode($filmAttributes, 'legion'));
        $dto->setFilmProtestant(self::getAttributesByCategoryCode($filmAttributes, 'protestant'));
        $dto->setFilmHarrison(self::getAttributesByCategoryCode($filmAttributes, 'harrison'));
        $dto->setFilmBoard(self::getAttributesByCategoryCode($filmAttributes, 'board'));

        return $dto;

    }
}