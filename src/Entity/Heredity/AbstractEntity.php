<?php

namespace App\Entity\Heredity;

use App\Entity\Definition\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }
}