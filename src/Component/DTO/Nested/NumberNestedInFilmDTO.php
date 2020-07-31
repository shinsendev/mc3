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
    private int $order;
    private string $title;
    private int $beginTc = 0;
    private int $endTc = 0;
    private int $length = 0;
    private array $performers = [];

    // categories for timeline visualisation
    private array $performance = [];
    private array $structure = [];
    private array $completeness = [];
    private array $diegetic = [];
    private array $cast = [];
    private array $source = []; // multiple choice

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

    /**
     * @return array
     */
    public function getPerformance(): array
    {
        return $this->performance;
    }

    /**
     * @param array $performance
     */
    public function setPerformance(array $performance): void
    {
        $this->performance = $performance;
    }

    /**
     * @return array
     */
    public function getStructure(): array
    {
        return $this->structure;
    }

    /**
     * @param array $structure
     */
    public function setStructure(array $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return array
     */
    public function getCompleteness(): array
    {
        return $this->completeness;
    }

    /**
     * @param array $completeness
     */
    public function setCompleteness(array $completeness): void
    {
        $this->completeness = $completeness;
    }

    /**
     * @return array
     */
    public function getDiegetic(): array
    {
        return $this->diegetic;
    }

    /**
     * @param array $diegetic
     */
    public function setDiegetic(array $diegetic): void
    {
        $this->diegetic = $diegetic;
    }

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @param array $source
     */
    public function setSource(array $source): void
    {
        $this->source = $source;
    }

    /**
     * @return array
     */
    public function getCast(): array
    {
        return $this->cast;
    }

    /**
     * @param array $cast
     */
    public function setCast(array $cast): void
    {
        $this->cast = $cast;
    }

}