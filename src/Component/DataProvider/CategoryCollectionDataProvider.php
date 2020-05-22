<?php

declare(strict_types=1);

namespace App\Component\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Entity\Category;

use Doctrine\ORM\EntityManagerInterface;

class CategoryCollectionDataProvider implements CollectionDataProviderInterface
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
     * @param string|null $operationName
     * @return \Generator|iterable
     */
    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        $categories = $this->em->getRepository(Category::class)->findAll();

        foreach ($categories as $category) {
            /** @var CategoryPayloadDTO */
            $categoryDTO = new CategoryPayloadDTO();
            $categoryDTO->hydrate(['category' => $category], $this->em);
            yield $categoryDTO;
        }
    }


}