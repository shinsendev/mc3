<?php

declare(strict_types=1);

namespace App\Component\DTO\Hierarchy;

use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * Class AbstractUniqueDTO
 * @package App\Component\DTO\Hierarchy
 */
abstract class AbstractUniqueDTO extends AbstractDTO
{
    /**
     * @ApiProperty(identifier=true)
     */
    protected $uuid;

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