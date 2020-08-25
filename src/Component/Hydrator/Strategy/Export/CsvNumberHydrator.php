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

        $numberAttributes = $number->getAttributes();
        // number attributes
        $dto->setBeginning(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'begin_thesaurus'));
        $dto->setEnding(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'ending_thesaurus'));
        $dto->setOutlines(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'complet_options'));
        $dto->setCompleteness(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'completeness_thesaurus'));
        $dto->setStructure(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'structure'));
        $dto->setPerformance(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'performance_thesaurus'));
        $dto->setCast(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'cast'));
        $dto->setSpectators(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'spectators_thesaurus'));
        $dto->setDiegeticPerformance(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'performance_thesaurus'));
        $dto->setMusicians(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'musician_thesaurus'));
        $dto->setTopic(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'genre'));
        $dto->setDiegeticPlace(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'diegetic_place_thesaurus'));
        $dto->setImaginaryPlace(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'imaginary'));
        $dto->setStereotype(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'stereotype'));
        $dto->setExoticism(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'exoticism_thesaurus'));
        $dto->setMusicalEnsemble(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'musensemble'));
        $dto->setTempo(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'tempo_thesaurus'));
        $dto->setMusicalStyles(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'musical_thesaurus'));
        $dto->setDanceEnsemble(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'dancemble'));
        $dto->setDancingType(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'dancing_type'));
        $dto->setDanceSubgenre(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'dance_subgenre'));
        $dto->setDanceContent(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'dance_content'));
        $dto->setSource(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'source_thesaurus'));
        $dto->setQuotation(ExportCsvHydrator::getAttributesByCategoryCode($numberAttributes, 'quotation_thesaurus'));

        // number people
        $dto->setNumberDirectors(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::DIRECTOR_PROFESSION));
        $dto->setPerformers(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::PERFORMER_PROFESSION));
        $dto->setStars(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::FIGURANT_PROFESSION));
        $dto->setArrangers(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::ARRANGER_PROFESSION));
        $dto->setDanceDirector(ExportCsvHydrator::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $number->getUuid(), Person::CHOREGRAPH_PROFESSION));

        return $dto;
    }

}