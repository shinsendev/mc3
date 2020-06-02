<?php

declare(strict_types=1);

namespace App\Component\Hydrator;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\Error\Mc3Error;
use App\Entity\Definition\EntityInterface;

/**
 * Class HydratorBasics
 * @package App\Component\Hydrator
 */
class HydratorBasics
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param array $params
     * @return DTOInterface
     */
    public static function hydrateDTOBase(DTOInterface $dto, array $data, array $params = []):DTOInterface
    {
        if (isset($params['excludes'])) {
            $excludes = $params['excludes'];
        }

        if (isset($params['mandatory'])) {
            $mandatory = $params['mandatory'];
        }

        $entity = $data[$data['model']];

        try {
            $reflection = new \ReflectionClass($dto);
        }
        catch (\ReflectionException $e) {
            throw new Mc3Error($e);
        }

        /** @var array $propertiesList */
        $propertiesList = $reflection->getProperties();

        // remove excludes property from array
        if (isset($excludes)) {
            $propertiesList = self::handleExclusion($propertiesList, $excludes);
        }

        // manage mandatory and remove them from array
        if (isset($mandatory)) {
            $propertiesList = self::handleMandatory($propertiesList, $mandatory, $dto, $entity);
        }

        // treat the other properties
        if (count($propertiesList) > 0) {
            foreach ($propertiesList as $property) {
                $getter = 'get'.ucfirst($property->getName());
                $setter = 'set'.ucfirst($property->getName());
                if (method_exists($entity, $getter) && $entity->$getter()) {
                    $dto->$setter($entity->$getter());
                }
            }
        }

        return $dto;
    }

    /**
     * @param array $propertiesList
     * @param array $excludes
     * @return array
     */
    public static function handleExclusion(array $propertiesList, array $excludes):array
    {
        foreach ($propertiesList as $index => $property) {
            if (in_array($property->getName(), $excludes)) {
                // remove and not update the index
                unset($propertiesList[$index]);
            }
        }

        return $propertiesList;
    }

    /**
     * @param array $propertiesList
     * @param array $mandatory
     * @param DTOInterface $dto
     * @param $entity
     * @return array
     */
    public static function handleMandatory(array $propertiesList, array $mandatory, DTOInterface $dto, EntityInterface $entity):array
    {
        foreach ($propertiesList as $index => $property) {
            if (in_array($property->getName(), $mandatory)) {
                $getter = 'get'.ucfirst($property->getName());
                $setter = 'set'.ucfirst($property->getName());
                $dto->$setter($entity->$getter());
                unset($propertiesList[$index]);
            }
        }

        return $propertiesList;
    }
}