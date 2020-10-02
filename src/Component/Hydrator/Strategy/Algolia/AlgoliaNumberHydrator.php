<?php


namespace App\Component\Hydrator\Strategy\Algolia;


use App\Component\DTO\Algolia\AlgoliaNumberPayloadDTO;
use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Definition\NumberPayloadInterface;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\Hierarchy\AbstractNumberHydrator;
use Doctrine\ORM\EntityManagerInterface;

class AlgoliaNumberHydrator extends AbstractNumberHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):NumberPayloadInterface
    {
        /** @var AlgoliaNumberPayloadDTO $dto */
        $dto = parent::hydrate($dto, $data, $em);

        /** @var Number $number */
        $number = $data['number'];

        if ($number->getEndTc() > 0 && $number->getShots() > 0) {
            $length = $number->getEndTc() - $number->getBeginTc();
            $dto->setLength($length);
        }

        return $dto;
    }
}
