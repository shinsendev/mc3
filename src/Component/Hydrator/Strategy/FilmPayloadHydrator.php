<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\HydratorBasics;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class FilmPayloadHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):FilmPayloadDTO
    {
        $params = [];
        // set excludes paramaters to treate manually
        $params['excludes'] = ['numbers'];
        $params['mandatory'] = ['uuid', 'title', 'imdb'];

        $data['model'] = 'film';
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        return $dto;
    }
}