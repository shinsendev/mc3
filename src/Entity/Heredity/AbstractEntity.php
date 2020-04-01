<?php

namespace App\Entity\Heredity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity
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