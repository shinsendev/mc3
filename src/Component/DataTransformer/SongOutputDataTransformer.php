<?php

declare(strict_types=1);

namespace App\Component\DataTransformer;

use App\Component\DTO\Payload\SongPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\SongPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataTransformer\DataTransformerInterface;

final class SongOutputDataTransformer implements DataTransformerInterface
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

    /**
     * @param object $song
     * @param string $to
     * @param array $context
     * @return SongPayloadDTO
     */
    public function transform($song, string $to, array $context = []): SongPayloadDTO
    {
        /** @var SongPayloadDTO  */
        $songDTO = DTOFactory::create(ModelConstants::SONG_PAYLOAD_MODEL);
        SongPayloadHydrator::hydrate($songDTO,['song' => $song], $this->em);

        return $songDTO;
    }

    /**
     * @param array|object $data
     * @param string $to
     * @param array $context
     * @return bool
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof SongPayloadDTO) {
            return false;
        }

        return SongPayloadDTO::class === $to && $data instanceof Song;

    }

}