<?php

namespace App\Component\Hydrator\Strategy\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CsvExportDTO;
use App\Component\Hydrator\Strategy\HydratorStrategyInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Number;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;

class CsvNumberHydrator implements HydratorStrategyInterface
{
    /**
     * @param CsvExportDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em): DTOInterface
    {
        /** @var Number $number */
        $number = $data['number'];

        // number general informations
        $dto->setNumberTitle($number->getTitle());
        $dto->setBeginTc($number->getBeginTc());
        $dto->setShots($number->getShots());
        $dto->setEndTc($number->getEndTc());
        $dto->setDubbing($number->getDubbing());
        $dto->setUuid($number->getUuid());

        // number attributes

        // number people
        $dto->setNumberDirectors(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::DIRECTOR_PROFESSION));
        $dto->setPerformers(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::PERFORMER_PROFESSION));
        $dto->setStars(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::FIGURANT_PROFESSION));
        $dto->setArrangers(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::ARRANGER_PROFESSION));
        $dto->setDanceDirector(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::CHOREGRAPH_PROFESSION));


        return $dto;
    }

}