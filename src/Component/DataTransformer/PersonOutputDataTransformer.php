<?php

declare(strict_types=1);

namespace App\Component\DataTransformer;

use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\PersonPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Hydrator\Strategy\PersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

final class PersonOutputDataTransformer implements DataTransformerInterface
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

    public function transform($person, string $to, array $context = [])
    {
        $personDTO = DTOFactory::create(ModelConstants::PERSON_PAYLOAD_MODEL);

        // hydrate DTO with data from $person
        /** @var PersonPayloadDTO $personDTO */
        $personDTO = PersonPayloadHydrator::hydrate($personDTO, ['person' => $person], $this->em);

        // return the payload
        return $personDTO;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof PersonPayloadHydrator) {
            return false;
        }

        return PersonPayloadDTO::class === $to && $data instanceof Person;
    }

}