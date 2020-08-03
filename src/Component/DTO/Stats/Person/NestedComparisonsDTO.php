<?php

namespace App\Component\DTO\Stats\Person;

use App\Component\DTO\Definition\DTOInterface;

/**
 * Class NestedComparisonsDTO
 * @package App\Component\DTO\Stats\Person
 */
class NestedComparisonsDTO implements DTOInterface
{
    private int $current;
    private int $average;
    private string $categoryUuid;
    private string $categoryCode;

    /**
     * @return int
     */
    public function getCurrent(): int
    {
        return $this->current;
    }

    /**
     * @param int $current
     */
    public function setCurrent(int $current): void
    {
        $this->current = $current;
    }

    /**
     * @return int
     */
    public function getAverage(): int
    {
        return $this->average;
    }

    /**
     * @param int $average
     */
    public function setAverage(int $average): void
    {
        $this->average = $average;
    }

    /**
     * @return string
     */
    public function getCategoryUuid(): string
    {
        return $this->categoryUuid;
    }

    /**
     * @param string $categoryUuid
     */
    public function setCategoryUuid(string $categoryUuid): void
    {
        $this->categoryUuid = $categoryUuid;
    }

    /**
     * @return string
     */
    public function getCategoryCode(): string
    {
        return $this->categoryCode;
    }

    /**
     * @param string $categoryCode
     */
    public function setCategoryCode(string $categoryCode): void
    {
        $this->categoryCode = $categoryCode;
    }

}