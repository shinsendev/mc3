<?php

namespace App\Component\Hydrator\Strategy\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CSV\CsvExportDTO;
use App\Component\Hydrator\Strategy\HydratorStrategyInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Person;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class CsvFilmHydrator implements HydratorStrategyInterface
{
    /**
     * @param CsvExportDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return CsvExportDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):CsvExportDTO
    {
        /** @var Film $film */
        $film = $data['film'];
        $filmAttributes = $film->getAttributes();

        // film general
        $dto->setFilmTitle($film->getTitle());
        $dto->setFilmReleased($film->getReleasedYear());
        $dto->setFilmSample($film->getSample());

        $dto->setFilmDirectors(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $film->getUuid(), Person::DIRECTOR_PROFESSION));

        if (count($film->getStudios()) > 0) {
            $dto->setFilmStudios(self::getStudios($film->getStudios()));
        }
        $dto->setFilmUuid($film->getuuid());
        $dto->setFilmImdb($film->getImdb());
        $dto->setFilmShows($film->getStageshows());
        $dto->setFilmRemake($film->getRemake());
        $dto->setFilmPca($film->getPca());
        $dto->setFilmCensorships(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'censorship'));
        $dto->setFilmStates(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'state'));
        $dto->setFilmLegion(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'legion'));
        $dto->setFilmProtestant(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'protestant'));
        $dto->setFilmHarrison(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'harrison'));
        $dto->setFilmBoard(ExportCsvHydrator::getAttributesByCategoryCode($filmAttributes, 'board'));

        return $dto;

    }

    /**
     * @param Collection $studios
     * @return string
     */
    public static function getStudios(Collection $studios):string
    {
        return ExportCsvHydrator::stringifyCollection($studios, 'getName');
    }
}