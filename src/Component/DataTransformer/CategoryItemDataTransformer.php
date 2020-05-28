<?php

declare(strict_types=1);


namespace App\Component\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Component\DTO\Payload\CategoryPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryItemDataTransformer implements DataTransformerInterface
{
    /** @var EntityManagerInterface */
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
     * @param $category
     * @param string $to
     * @param array $context
     * @return \App\Component\DTO\Definition\DTOInterface|mixed
     */
    public function transform($category, string $to, array $context = [])
    {
        $categoryDTO =  DTOFactory::create(ModelConstants::CATEGORY_PAYLOAD_MODEL);
        $categoryDTO->hydrate(['category' => $category], $this->em);

        return $categoryDTO;
    }

    /**
     * @param $data
     * @param string $to
     * @param array $context
     * @return bool
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof CategoryPayloadDTO) {
            return false;
        }

        return CategoryPayloadDTO::class === $to && $data instanceof Category;

    }
}