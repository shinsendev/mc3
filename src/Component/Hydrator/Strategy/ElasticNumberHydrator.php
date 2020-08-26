<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Definition\NumberPayloadInterface;
use App\Component\DTO\Elastic\ElasticIndexationDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Attribute\AttributeManyToManyHydrator;
use App\Component\Hydrator\Attribute\AttributeManyToOneHydrator;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Helper\AttributeHelper;
use App\Component\Hydrator\Helper\PersonHelper;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Hydrator\Strategy\Hierarchy\AbstractNumberHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;

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
        $dto = self::setFilmObject($number->getFilm(), $dto);

        // add songs
        $dto = self::setSongsObject($number->getSongs(), $dto);

        // unset some useless var
        // todo add operations

        return $dto;
    }

    private static function setFilmObject(Film $film, NumberPayloadInterface $dto):NumberPayloadInterface
    {
        return $dto;
    }

    private static function setSongsObject(array $songs, NumberPayloadInterface $dto):NumberPayloadInterface
    {
        return $dto;
    }

}