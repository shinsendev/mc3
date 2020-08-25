<?php


namespace App\Component\Hydrator\Strategy;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CsvExportDTO;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;

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
        $film = $number->getFilm();
        $filmAttributes = $film->getAttributes();

        // film
        $dto->setFilmTitle($film->getTitle());
        $dto->setFilmCensorships(self::getAttributesByCategoryCode($filmAttributes, 'censorship'));
        $dto->setFilmReleased($film->getReleasedYear());

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

    private static function getSongs(PersistentCollection $songs):string
    {
        return self::stringifyCollection($songs, 'getTitle');
    }

    public static function stringifyCollection(PersistentCollection $array, string $getter):string
    {
        $collectionInString = null;
        foreach ($array as $item) {
            $collectionInString = self::stringifyItem($item, $collectionInString, $getter);
        }

        return $collectionInString;
    }

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