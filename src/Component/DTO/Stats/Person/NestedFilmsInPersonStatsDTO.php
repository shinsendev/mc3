<?php

declare(strict_types=1);


namespace App\Component\DTO\Stats\Person;

/**
 * Class NestedFilmsInPersonStatsDTO
 * @package App\Component\DTO\Stats\Person
 */
class NestedFilmsInPersonStatsDTO
{
    private string $title;

    private string $uuid;

    private string $imdb;

    private int $releasedYear;

    private int $totalNumberLength;

    private int $totalPersonNumberLength;

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

    /**
     * @return string
     */
    public function getImdb(): string
    {
        return $this->imdb;
    }

    /**
     * @param string $imdb
     */
    public function setImdb(string $imdb): void
    {
        $this->imdb = $imdb;
    }

    /**
     * @return int
     */
    public function getReleasedYear(): int
    {
        return $this->releasedYear;
    }

    /**
     * @param int $releasedYear
     */
    public function setReleasedYear(int $releasedYear): void
    {
        $this->releasedYear = $releasedYear;
    }

    /**
     * @return int
     */
    public function getTotalNumberLength(): int
    {
        return $this->totalNumberLength;
    }

    /**
     * @param int $totalNumberLength
     */
    public function setTotalNumberLength(int $totalNumberLength): void
    {
        $this->totalNumberLength = $totalNumberLength;
    }

    /**
     * @return int
     */
    public function getTotalPersonNumberLength(): int
    {
        return $this->totalPersonNumberLength;
    }

    /**
     * @param int $totalPersonNumberLength
     */
    public function setTotalPersonNumberLength(int $totalPersonNumberLength): void
    {
        $this->totalPersonNumberLength = $totalPersonNumberLength;
    }

}