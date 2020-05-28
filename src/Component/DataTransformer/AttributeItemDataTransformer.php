<?php

declare(strict_types=1);

namespace App\Component\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Component\DTO\Payload\AttributePayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\AttributePayloadHydrator;
use App\Component\Hydrator\Strategy\NestedAttributeInCategory;
use App\Component\Model\ModelConstants;
use App\Entity\Attribute;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AttributeItemDataTransformer
 * @package App\Component\DataTransformer
 */
class AttributeItemDataTransformer implements DataTransformerInterface
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
     * @param object $attribute
     * @param string $to
     * @param array $context
     * @return \App\Component\DTO\Definition\DTOInterface|mixed|object
     */
    public function transform($attribute, string $to, array $context = [])
    {
        $attributeDTO =  DTOFactory::create(ModelConstants::ATTRIBUTE_PAYLOAD_MODEL);
        AttributePayloadHydrator::hydrate($attributeDTO, ['attribute' => $attribute], $this->em);

        return $attributeDTO;
    }

    /**
     * @param array|object $data
     * @param string $to
     * @param array $context
     * @return bool
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a DTO we transformed the data already
        if ($data instanceof AttributePayloadDTO) {
            return false;
        }

        return AttributePayloadDTO::class === $to && $data instanceof Attribute;

    }
}