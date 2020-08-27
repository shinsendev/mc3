<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy\Elastic;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Definition\NumberPayloadInterface;
use App\Component\DTO\Elastic\ElasticIndexationDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\Hierarchy\AbstractNumberHydrator;
use App\Component\Model\ModelConstants;
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

        if ($number->getEndTc()>0 && $number->getShots() > 0) {
            $length = $number->getEndTc() - $number->getBeginTc();
            $average = (int)round($length / $number->getShots());
            $dto->setAverageShotLength($average);
        }

        // add film
        $dto = self::setFilmObject($number->getFilm(), $dto, $em);

        // add songs
        $dto = self::setSongsObject($number->getSongs(), $dto, $em);

        // unset some useless var
        // todo add operations

        return $dto;
    }

    private static function setFilmObject(Film $film, ElasticIndexationDTO $dto, EntityManagerInterface $em):NumberPayloadInterface
    {
        $filmDTO = DTOFactory::create(ModelConstants::ELASTIC_NESTED_FILM_DTO);
        $filmDTO = ElasticNestedFilmHydrator::hydrate($filmDTO, ["film"=>$film], $em);
        $dto->setFilmObject($filmDTO);
        return $dto;
    }

    private static function setSongsObject(Collection $songs, ElasticIndexationDTO $dto, EntityManagerInterface $em):NumberPayloadInterface
    {
        $songDTO = DTOFactory::create(ModelConstants::ELASTIC_NESTED_SONG_DTO);

        return $dto;
    }

}