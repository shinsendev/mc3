<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FilmItemDataProvider
 * @package App\Component\DataProvider
 */
final class FilmItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
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
     * @param string $resourceClass
     * @param array|int|string $uuid
     * @param string|null $operationName
     * @param array $context
     * @return Film
     */
    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :Film
    {
        if (!$film = $this->em->getRepository(Film::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No film found with uuid " . $uuid);
        }

        return $film;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Film::class === $resourceClass;
    }
}