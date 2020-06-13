<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Film;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class FilmItemDataProvider
 * @package App\Component\DataProvider
 */
final class NumberItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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
     * @return Number
     */
    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :Number
    {
        if (!$number = $this->em->getRepository(Number::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No number found with uuid " . $uuid);
        }

        return $number;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return bool
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Number::class === $resourceClass;
    }
}