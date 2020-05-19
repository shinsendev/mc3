<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FictionItemDataProvider
 * @package App\Component\DataProvider
 */
class FilmItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :?FilmPayloadDTO
    {
        if (!$film = $this->em->getRepository(Film::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No film found with uuid " . $uuid);
        }

        /** @var FilmPayloadDTO  */
        $filmDTO = new FilmPayloadDTO();
        $filmDTO->setTitle($film->getTitle());
        $filmDTO->setUuid($film->getUuid());

        return $filmDTO;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return FilmPayloadDTO::class === $resourceClass;
    }

}