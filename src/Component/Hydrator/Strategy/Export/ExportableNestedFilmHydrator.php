<?php


namespace App\Component\Hydrator\Strategy\Export;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\Nested\ExportableFilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\NestedPersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ElasticNestedFilmHydrator
 * @package App\Component\Hydrator\Strategy\Elastic
 */
class ExportableNestedFilmHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):ExportableFilmNestedDTO
    {
        /** @var Film $film */
        $film = $data['film'];

        $dto->setReleasedYear($film->getReleasedYear());
        $dto->setSample($film->getSample());

        if ($directors = $em->getRepository(Work::class)->findPersonByTargetAndProfession('film', $film->getUuid(),'director')) {
            $dto->setDirectors(self::getPeople($directors, $em));
        }

        $dto->setLength($film->getLength());

        // set attributes
        $attributes = $film->getAttributes();
        $dto->setAdaptation(self::getAttributeByCategoryCode($attributes, Category::ADAPTATION_CODE));
        $dto->setCensorships(self::getAttributesByCategoryCode($attributes, Category::CENSORSHIP_CODE));
        $dto->setLegion(self::getAttributesByCategoryCode($attributes, Category::LEGION_CODE));
        $dto->setPca(self::getAttributesByCategoryCode($attributes, Category::PCA_CODE));
        $dto->setStates(self::getAttributesByCategoryCode($attributes, Category::STATES_CODE));
        $dto->setHarrison(self::getAttributesByCategoryCode($attributes, Category::HARRISSON_CODE));
        $dto->setBoard(self::getAttributesByCategoryCode($attributes, Category::BOARD_CODE));
        $dto->setStudios(self::getStudios($film));

        return $dto;
    }

    public static function getPeople($people, EntityManagerInterface $em)
    {
        $peopleList = [];
        foreach ($people as $person) {
            $personDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $peopleList[] = NestedPersonPayloadHydrator::hydrate($personDTO, ['person' => $person], $em);
        }

        return $peopleList;
    }

    public static function getAttributesByCategoryCode($attributes, $needle)
    {
        $attributesList = [];
        foreach ($attributes as $attribute) {
            if ($attribute->getCategory()->getCode() === $needle) {
                $attributesList[] = $attribute->getTitle();
            }
        }

        return $attributesList;
    }

    public static function getAttributeByCategoryCode($attributes, $needle)
    {
        $attributesString = null;
        foreach ($attributes as $attribute) {
            if ($attribute->getCategory()->getCode() === $needle) {
                $attributesString = $attribute->getTitle();
            }
        }

        return $attributesString;
    }

    public static function getStudios(Film $film):array
    {
        $studios = [];

        if ($film->getStudios()) {
            foreach ($film->getStudios() as $studio) {
                $studios[] = ['name' => $studio->getName()];
            }
        }

        return $studios;
    }
    
}