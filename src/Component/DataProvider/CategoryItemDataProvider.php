<?php

declare(strict_types=1);


namespace App\Component\DataProvider;


use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;
use Entity\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getItem(string $resourceClass, $uuid, string $operationName = null, array $context = []) :Attribute
    {
        if (!$category = $this->em->getRepository(Category::class)->findOneByUuid($uuid)) {
            throw new NotFoundHttpException("No category found with uuid " . $uuid);
        }

        return $category;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Category::class === $resourceClass;
    }
}