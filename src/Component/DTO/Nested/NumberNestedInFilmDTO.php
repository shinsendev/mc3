<?php

declare(strict_types=1);


namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NumberNestedInFilmDTO
 * @package App\Component\DTO\Nested
 */
class NumberNestedInFilmDTO extends AbstractUniqueDTO
{
    /** @var int */
    private $order;

    /** @var string */
    private $title;

    /** @var int */
    private $beginTc;

    /** @var int */
    private $endTc;

    /** @var int */
    private $length;

    /** @var array */
    private $performers = [];

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getBeginTc(): ?int
    {
        return $this->beginTc;
    }

    /**
     * @param int $beginTc
     */
    public function setBeginTc(int $beginTc): void
    {
        $this->beginTc = $beginTc;
    }

    /**
     * @return int
     */
    public function getEndTc(): ?int
    {
        return $this->endTc;
    }

    /**
     * @param int $endTc
     */
    public function setEndTc(int $endTc): void
    {
        $this->endTc = $endTc;
    }

    /**
     * @return int
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return array
     */
    public function getPerformers(): array
    {
        return $this->performers;
    }

    /**
     * @param array $performers
     */
    public function setPerformers(array $performers): void
    {
        $this->performers = $performers;
    }

}