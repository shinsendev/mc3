<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FictionItemDataProvider
 * @package App\Component\DataProvider
 */
class SongItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    /**
     * SongItemDataProvider constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    /**
     * @param string $resourceClass
     * @param array|int|string $uuid
     * @param string|null $operationName
     * @param array $context
     * @return SongPayloadDTO|null
     */
    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :?SongPayloadDTO
    {
        if (!$song = $this->em->getRepository(Song::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No song found with uuid " . $uuid);
        }

        /** @var SongPayloadDTO  */
        $songDTO = new SongPayloadDTO();
        $songDTO->hydrate(['song' => $song]);

        return $songDTO;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return SongPayloadDTO::class === $resourceClass;
    }

}