<?php


namespace App\Component\Hydrator\Strategy\Export;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\CsvExportDTO;
use App\Component\Hydrator\Strategy\HydratorStrategyInterface;
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

        // hydrate film data
        $dto = CsvFilmHydrator::hydrate($dto, ['film' => $number->getFilm()], $em);

        // hydrate number data
        $dto = CsvNumberHydrator::hydrate($dto, $data, $em);

        // hydrate songs
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
    public static function getAttributesByCategoryCode($attributes, $needle)
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
    public static function getPeopleByProfession(EntityManagerInterface $em, $targetModel, $targetUuid, $profession):?string
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
     * @param Collection $songs
     * @return string
     */
    public static function getSongs(Collection $songs):string
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