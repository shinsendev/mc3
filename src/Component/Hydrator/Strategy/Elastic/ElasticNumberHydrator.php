<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy\Elastic;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Definition\NumberPayloadInterface;
use App\Component\DTO\Elastic\ElasticIndexationDTO;
use App\Component\DTO\Nested\Elastic\ElasticSongNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\Hierarchy\AbstractNumberHydrator;
use App\Component\Hydrator\Strategy\NestedSongHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Film;
use App\Entity\Number;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class ElasticNumberHydrator extends AbstractNumberHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return ElasticIndexationDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):NumberPayloadInterface
    {
        $dto = parent::hydrate($dto, $data, $em);

        /** @var Number $number */
        $number = $data['number'];
        $datetime = new \DateTime();
        $releasedYearInDate = $datetime->setDate($number->getFilm()->getReleasedYear(), 1, 1)->format('Y-m-d');
        $dto->setReleasedYearInDate($releasedYearInDate);

        if ($number->getEndTc() > 0 && $number->getShots() > 0) {
            $length = $number->getEndTc() - $number->getBeginTc();
            $average = (int)round($length / $number->getShots());
            $dto->setLength($length);
            $dto->setAverageShotLength($average);
        }

        // add film
        $dto = self::setFilmObject($number->getFilm(), $dto, $em);

        // add songs
        $dto = self::setSongsObject($number->getSongs(), $dto, $em);

        return $dto;
    }

    private static function setFilmObject(Film $film, ElasticIndexationDTO $dto, EntityManagerInterface $em):ElasticIndexationDTO
    {
        $filmDTO = DTOFactory::create(ModelConstants::ELASTIC_NESTED_FILM_DTO);
        $filmDTO = ElasticNestedFilmHydrator::hydrate($filmDTO, ["film"=>$film], $em);

        if ($studios = $film->getStudios()) {
            foreach ($studios as $studio) {
                $studiosArray[] = ['name' => $studio->getName()];
                $studio = null;
            }
            if (isset($studiosArray)) {
                $filmDTO->setStudios($studiosArray);
            }
            $studiosArray = null;
        }

        if ($attributes = $film->getAttributes()) {
            $censorships = [];
            $pca = [];
            $states = [];

            foreach ($attributes as $attribute) {
                $censorships = self::addAttributeByType($attribute,Category::CENSORSHIP_CODE, $censorships);
                $pca = self::addAttributeByType($attribute,Category::PCA_CODE, $pca);
                $states = self::addAttributeByType($attribute,Category::STATES_CODE, $states);

                // many to one
                if ($attribute->getCategory()->getCode() === Category::ADAPTATION_CODE) {
                    $filmDTO->setAdaptation($attribute->getTitle());
                }

                $attribute = null;
            }

            // set all many to many attributes
            if ($censorships) {
                $filmDTO->setCensorships($censorships);
                $censorships = null;
            }

            if ($pca) {
                $filmDTO->setPca($pca);
                $pca = null;
            }

            if ($states) {
                $filmDTO->setStates($states);
                $states = null;
            }

            $filmDTO->setLength($film->getLength());
        }

        $dto->setFilmObject($filmDTO);
        return $dto;
    }

    private static function addAttributeByType(Attribute $attribute, string $categoryCode, array $attributes):array
    {
        if ($attribute->getCategory()->getCode() === $categoryCode) {
            $attributes[] = ["title" => $attribute->getTitle()];
        }

        return $attributes;
    }

    private static function setSongsObject(Collection $songs, ElasticIndexationDTO $dto, EntityManagerInterface $em):NumberPayloadInterface
    {
        $songsDTO = [];
        foreach($songs as $song) {
            $songDTO = DTOFactory::create(ModelConstants::ELASTIC_NESTED_SONG_DTO);
            $songsDTO[] = ElasticNestedSongHydrator::hydrate($songDTO, ['song' => $song], $em);
        }
        $dto->setSongs($songsDTO);

        return $dto;
    }

}