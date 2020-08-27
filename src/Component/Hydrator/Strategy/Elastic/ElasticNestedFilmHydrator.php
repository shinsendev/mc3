<?php


namespace App\Component\Hydrator\Strategy\Elastic;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\Elastic\ElasticFilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\NestedPersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ElasticNestedFilmHydrator
 * @package App\Component\Hydrator\Strategy\Elastic
 */
class ElasticNestedFilmHydrator implements HydratorDTOInterface
{
    /**
     * @param ElasticFilmNestedDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return ElasticFilmNestedDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em)
    {
        /** @var Film $film */
        $film = $data['film'];

        $dto->setReleasedYear($film->getReleasedYear()); // todo: convert into date
        $dto->setSample($film->getSample());

        if ($directors = $em->getRepository(Work::class)->findPersonByTargetAndProfession('film', $film->getUuid(),'director')) {
            $dto->setDirectors(self::getPeople($directors, $em));
        }

        // set attributes$
        $attributes = $film->getAttributes();
        $dto->setAdaptation(self::getAttributeByCategoryCode($attributes, 'adaptation'));
        $dto->setCensorships(self::getAttributesByCategoryCode($attributes, 'censorships'));
        $dto->setLegion(self::getAttributesByCategoryCode($attributes, 'legion'));
        $dto->setPca(self::getAttributesByCategoryCode($attributes, 'pca'));
        $dto->setStates(self::getAttributesByCategoryCode($attributes, 'states'));
        $dto->setStudios(self::getStudios($film->getStudios()));

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

    public static function getStudios($studios)
    {
        $studiosList = [];
        foreach ($studios as $studio) {
            $studioList[] = $studio->getName();
        }

        return $studiosList;
    }
    
}