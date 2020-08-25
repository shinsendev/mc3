<?php


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CsvExportDTO;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Person;
use App\Entity\Work;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class ExportCsvHydrator implements HydratorStrategyInterface
{
    /**
     * @param CsvExportDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return DTOInterface
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em): DTOInterface
    {
        $number = $data['number'];
        /** @var Film $film */
        $film = $number->getFilm();
        $filmAttributes = $film->getAttributes();

        // film
        $dto->setFilmTitle($film->getTitle());
        $dto->setFilmReleased($film->getReleasedYear());
        $dto->setFilmSample($film->getSample());

//        $directors = $em->getRepository(Work::class)->findPersonByTargetAndProfession('film', $film->getUuid(), 'director');
        $dto->setFilmDirectors(self::getPeopleByProfession($em, ModelConstants::FILM_MODEL, $film->getUuid(), Person::DIRECTOR_PROFESSION));

        if (count($film->getStudios()) > 0) {
            $dto->setFilmStudios(self::getStudios($film->getStudios()));
        }
        $dto->setFilmUuid($film->getuuid());
        $dto->setFilmImdb($film->getImdb());
        $dto->setFilmShows($film->getStageshows());
        $dto->setRemake($film->getRemake());
        $dto->setPca($film->getPca());
        $dto->setFilmCensorships(self::getAttributesByCategoryCode($filmAttributes, 'censorship'));
        $dto->setStates(self::getAttributesByCategoryCode($filmAttributes, 'state'));
        $dto->setLegion(self::getAttributesByCategoryCode($filmAttributes, 'legion'));
        $dto->setProtestant(self::getAttributesByCategoryCode($filmAttributes, 'protestant'));
        $dto->setBoard(self::getAttributesByCategoryCode($filmAttributes, 'board'));


        // number
        $dto->setNumberTitle($number->getTitle());
        $dto->setBeginTc($number->getBeginTc());
        $dto->setEndTc($number->getEndTc());

        // songs
        if (count($number->getSongs()) > 0) {
            $dto->setSongs(self::getSongs($number->getSongs()));
        }

        return $dto;

    }

    /**
     * @param $attributes
     * @param $needle
     * @return string|null
     */
    private static function getAttributesByCategoryCode($attributes, $needle)
    {
        $attributesTitle = null;
        foreach ($attributes as $attribute) {
            if ($attribute->getCategory()->getCode() === $needle) {
                if (!$attributesTitle) {
                    $attributesTitle = $attribute->getTitle();
                }
                else {
                    $attributesTitle .= ','.$attribute->getTitle();
                }
             }
        }

        return $attributesTitle;
    }

    /**
     * @param EntityManagerInterface $em
     * @param $targetModel
     * @param $targetUuid
     * @param $profession
     * @return string|null
     */
    private static function getPeopleByProfession(EntityManagerInterface $em, $targetModel, $targetUuid, $profession):?string
    {
        $peopleStringified = null;

        // we get all the people in entity
        $collection = $em->getRepository(Work::class)->findPersonByTargetAndProfession($targetModel, $targetUuid, $profession);

        // we convert their fullname into strings
        foreach ($collection as $person) {
            if (!$peopleStringified) {
                $peopleStringified .= $person->getFirstname(). ''.$person->getLastname();
            }
            else {
                $peopleStringified .= ','.$person->getFirstname(). ''.$person->getLastname();
            }
        }

        return $peopleStringified;
    }

    /**
     * @param Collection $studios
     * @return string
     */
    private static function getStudios(Collection $studios):string
    {
        return self::stringifyCollection($studios, 'getName');
    }

    /**
     * @param Collection $songs
     * @return string
     */
    private static function getSongs(Collection $songs):string
    {
        return self::stringifyCollection($songs, 'getTitle');
    }

    /**
     * @param Collection $array
     * @param string $getter
     * @return string
     */
    public static function stringifyCollection(Collection $array, string $getter):string
    {
        $collectionInString = null;
        foreach ($array as $item) {
            $collectionInString = self::stringifyItem($item, $collectionInString, $getter);
        }

        return $collectionInString;
    }

    /**
     * @param $item
     * @param $string
     * @param $getter
     * @return string
     */
    public static function stringifyItem($item, $string, $getter):string
    {
        if (!$string) {
            $string .= $item->$getter();
        }
        else {
            $string .= ','.$item->$getter();
        }

        return $string;
    }

}