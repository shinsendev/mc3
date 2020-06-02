<?php

declare(strict_types=1);

namespace App\Component\DataTransformer;

use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

final class FilmOutputDataTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * SongItemDataProvider constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function transform($film, string $to, array $context = [])
    {
        // change data provider
        $filmDTO = DTOFactory::create(ModelConstants::FILM_PAYLOAD_MODEL);

        // hydrate DTO with data from $film
        /** @var FilmPayloadDTO $filmDTO */
        $filmDTO = FilmPayloadHydrator::hydrate($filmDTO, ['film' => $film], $this->em);

        // return the payload
        return $filmDTO;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof FilmPayloadDTO) {
            return false;
        }

        return FilmPayloadDTO::class === $to && $data instanceof Film;

    }

}