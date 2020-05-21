<?php

declare(strict_types=1);


namespace App\Component\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\DTO\Payload\SongPayloadDTO;
use App\Entity\Category;
use App\Entity\Song;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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

    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :?CategoryPayloadDTO
    {
        if (!$category = $this->em->getRepository(Category::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No category found with uuid " . $uuid);
        }

        $categoryDTO = new CategoryPayloadDTO();
        $categoryDTO->hydrate(['category' => $category], $this->em);

        return $categoryDTO;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return CategoryPayloadDTO::class === $resourceClass;
    }
}