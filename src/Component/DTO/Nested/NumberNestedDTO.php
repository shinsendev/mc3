<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

/**
 * Class NumberNestedDTO
 * @package App\Component\DTO\Nested
 */
class NumberNestedDTO
{
    /** @var string */
    private $name;

    /** @var string */
    private $uuid;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}