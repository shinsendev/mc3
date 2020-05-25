<?php

declare(strict_types=1);


namespace App\Component\Hydrator;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\Error\Mc3Error;

class HydratorBasics
{
    public static function hydrateDTOBase(DTOInterface $dto, array $data, array $params = [])
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
            foreach ($propertiesList as $index => $property) {
                if (in_array($property->getName(), $mandatory)) {
                    $getter = 'get'.ucfirst($property->getName());
                    $setter = 'set'.ucfirst($property->getName());
                    $dto->$setter($entity->$getter());
                    array_splice($propertiesList, $index, 1);
                }
            }
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
    public function handleExclusion(array $propertiesList, array $excludes):array
    {
        foreach ($propertiesList as $index => $property) {
            if (in_array($property->getName(), $excludes)) {
                array_splice($propertiesList, $index, 1);
            }
        }

        return $propertiesList;
    }
    
    public static function handleMandatory()
    {

    }
}