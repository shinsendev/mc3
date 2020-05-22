<?php

declare(strict_types=1);


namespace App\Component\Factory;


use App\Entity\Attribute;
use App\Entity\Category;
use App\Entity\Definition\EntityInterface;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Person;
use App\Entity\Song;

/**
 * Class EntityFactory
 * @package App\Component\Factory
 */
class EntityFactory
{
    /**
     * @param string $entityName
     * @return mixed
     */
    public static function create(string $entityName):EntityInterface
    {
        $config = [
            'song' => new Song(),
            'number' => new Number(),
            'film' => new Film(),
            'attribute' => new Attribute(),
            'category' => new Category(),
            'person' => new Person(),
        ];

        foreach ($config as $configEntityName => $entity) {
            if ($entityName === $configEntityName) {
                return $entity;
            }
        }
    }
}