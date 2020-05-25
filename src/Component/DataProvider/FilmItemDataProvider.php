<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Model\ModelConstants;
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

        // create film DTO with factory
        /** @var FilmPayloadDTO  */
        $filmDTO = DTOFactory::create( ModelConstants::FILM_PAYLOAD_MODEL);

        // hydrate DTO with data from $film
        /** @var FilmPayloadDTO $filmDTO */
        $filmDTO = FilmPayloadHydrator::hydrate($filmDTO, ['film' => $film], $this->em);

        // return the payload
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