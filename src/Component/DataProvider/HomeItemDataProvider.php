<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\HomePayloadDTO;
use App\Component\Error\Mc3Error;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;

class HomeItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        // maybe useless but we check it it is the expected uuid
        if($id !== $_ENV['HOME_UUID']) {
            throw new Mc3Error('Not the correct uuid for hompage', 403);
        }

        $homeDTO = DTOFactory::create(ModelConstants::HOME_PAYLOAD_MODEL);
        $homeDTO->hydrate(['uuid' => $_ENV['HOME_UUID']], $this->em);

        return $homeDTO;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return HomePayloadDTO::class === $resourceClass;
    }
}