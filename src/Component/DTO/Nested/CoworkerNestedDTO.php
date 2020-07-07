<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Definition\DTOInterface;

/**
 * Class CoworkerNestedDTO
 * @package App\Component\DTO\Nested
 */
class CoworkerNestedDTO implements DTOInterface
{
    /** @var string  */
    private string $fullname;

    /** @var string  */
    private string $uuid;

    /** @var int  */
    private int $count;

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count): void
    {
        $this->count = $count;
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