<?php


namespace App\Component\Hydrator\Strategy\Hierarchy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Definition\NumberPayloadInterface;
use App\Component\DTO\Export\Heredity\ExportableDTO;
use App\Component\DTO\Export\Nested\ExportableFilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\Export\ExportableNestedFilmHydrator;
use App\Component\Hydrator\Strategy\Export\ExportableNestedSongHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Film;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractExportableHydrator extends AbstractNumberHydrator
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):NumberPayloadInterface
    {
        /** @var ExportableDTO $dto */
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

    private static function setFilmObject(Film $film, ExportableDTO $dto, EntityManagerInterface $em):ExportableDTO
    {
        $filmDTO = DTOFactory::create(ModelConstants::EXPORTABLE_NESTED_FILM_DTO);
        $filmDTO = ExportableNestedFilmHydrator::hydrate($filmDTO, ["film"=>$film], $em);
        $dto->setFilmObject($filmDTO);

        return $dto;
    }

    private static function setSongsObject(Collection $songs, ExportableDTO $dto, EntityManagerInterface $em):NumberPayloadInterface
    {
        $songsDTO = [];
        foreach($songs as $song) {
            $songDTO = DTOFactory::create(ModelConstants::EXPORTABLE_NESTED_SONG_DTO);
            $songsDTO[] = ExportableNestedSongHydrator::hydrate($songDTO, ['song' => $song], $em);
        }
        $dto->setSongsObject($songsDTO);

        return $dto;
    }
}
