<?php


namespace App\Component\DTO\Stats\Person;


use App\Component\DTO\Definition\DTOInterface;

class NestedComparisonsDTO implements DTOInterface
{
    private int $current;
    private int $target;
    private string $categoryUuid;
    private string $catagoryCode;

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
    public function getTarget(): int
    {
        return $this->target;
    }

    /**
     * @param int $target
     */
    public function setTarget(int $target): void
    {
        $this->target = $target;
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
    public function getCatagoryCode(): string
    {
        return $this->catagoryCode;
    }

    /**
     * @param string $catagoryCode
     */
    public function setCatagoryCode(string $catagoryCode): void
    {
        $this->catagoryCode = $catagoryCode;
    }

}