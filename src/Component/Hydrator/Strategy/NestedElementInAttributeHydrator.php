<?php


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class NestedElementInAttributeHydrator
 * @package App\Component\Hydrator\Strategy
 */
class NestedElementInAttributeHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):DTOInterface
    {
        $element = $data['element'];
        $dto->setTitle($element['title']);
        $dto->setUuid($element['uuid']);
        $dto->setYears(self::getYears($element, $em));

        return $dto;
    }

    /**
     * @param array $element
     * @param EntityManagerInterface $em
     * @return array
     */
    private static function getYears(array $element, EntityManagerInterface $em)
    {
        switch($element['model']) {
            case ModelConstants::FILM_MODEL:
                $repository = $em->getRepository(Film::class);
                return [$repository->findOneByUuid($element['uuid'])->getReleasedyear()];
            case ModelConstants::NUMBER_MODEL:
                $repository = $em->getRepository(Number::class);
                return [$repository->getFilmReleasedYear($element['uuid'])];
            case ModelConstants::SONG_MODEL:
                $repository = $em->getRepository(Song::class);
                $years = $repository->getFilmsReleasedYears($element['uuid']);
                $result = [];
                foreach ($years as $year) {
                    if (!in_array($year['releasedYear'], $result))
                    $result[] = $year['releasedYear'];
                }
                return $result;
        }

        return [];
    }
}