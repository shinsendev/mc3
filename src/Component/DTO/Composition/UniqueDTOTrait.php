<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition;

use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * Trait UniqueDTOTrait
 * @package App\Component\DTO\Composition
 */
trait UniqueDTOTrait
{
    /**
     * @ApiProperty(identifier=true)
     */
    private $uuid;

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param mixed $uuid
     */
    public function setUuid($uuid): void
    {
        $this->uuid = $uuid;
    }
}