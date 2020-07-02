<?php

declare(strict_types=1);


namespace App\Component\DTO\Stats\Person;

/**
 * Class PersonStatsDTO
 * @package App\Component\DTO\Stats
 */
class PersonStatsDTO
{
    private int $averageShotLength = 0;

    /** @var NestedFilmsInPersonStatsDTO[] */
    private array $films = [];

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

}
