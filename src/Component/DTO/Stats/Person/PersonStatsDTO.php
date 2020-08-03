<?php

declare(strict_types=1);


namespace App\Component\DTO\Stats\Person;

use App\Component\DTO\Definition\DTOInterface;

/**
 * Class PersonStatsDTO
 * @package App\Component\DTO\Stats
 */
class PersonStatsDTO implements DTOInterface
{
    private int $averageShotLength = 0;

    /** @var NestedFilmsInPersonStatsDTO[] */
    private array $films = [];

    /** @var NestedComparisonsDTO[] */
    private array $comparisons = [];

    /**
     * @return int
     */
    public function getAverageShotLength(): int
    {
        return $this->averageShotLength;
    }

    /**
     * @param int $averageShotLength
     */
    public function setAverageShotLength(int $averageShotLength): void
    {
        $this->averageShotLength = $averageShotLength;
    }

    /**
     * @return NestedFilmsInPersonStatsDTO[]
     */
    public function getFilms(): array
    {
        return $this->films;
    }

    /**
     * @param NestedFilmsInPersonStatsDTO[] $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }

    /**
     * @return NestedComparisonsDTO[]
     */
    public function getComparisons(): array
    {
        return $this->comparisons;
    }

    /**
     * @param NestedComparisonsDTO[] $comparisons
     */
    public function setComparisons(array $comparisons): void
    {
        $this->comparisons = $comparisons;
    }

}
