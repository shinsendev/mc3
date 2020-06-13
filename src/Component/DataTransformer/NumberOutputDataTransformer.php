<?php

declare(strict_types=1);

namespace App\Component\DataTransformer;

use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Hydrator\Strategy\NumberPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

final class NumberOutputDataTransformer implements DataTransformerInterface
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

    public function transform($number, string $to, array $context = [])
    {
        // change data provider
        $numberDTO = DTOFactory::create(ModelConstants::NUMBER_PAYLOAD_MODEL);

        // hydrate DTO with data from $film
        /** @var NumberPayloadDTO $filmDTO */
        $numberDTO = NumberPayloadHydrator::hydrate($numberDTO, ['number' => $number], $this->em);

        // return the payload
        return $numberDTO;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof NumberPayloadDTO) {
            return false;
        }

        return NumberPayloadDTO::class === $to && $data instanceof Number;

    }

}