<?php


namespace App\Component\Hydrator\Strategy\Elastic;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use Doctrine\ORM\EntityManagerInterface;

class ElasticNestedFilmHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em)
    {
        dd('dans l');
        // TODO: Implement hydrate() method.

        return $dto;
    }

}