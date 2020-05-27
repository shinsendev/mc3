<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\AttributePayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AttributeItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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

    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :?AttributePayloadDTO
    {
        if (!$attribute = $this->em->getRepository(Attribute::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No attribute found with uuid " . $uuid);
        }

        $attributeDTO =  DTOFactory::create(ModelConstants::ATTRIBUTE_PAYLOAD_MODEL);
        $attributeDTO->hydrate(['attribute' => $attribute], $this->em);

        return $attributeDTO;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Attribute::class === $resourceClass;
    }
}