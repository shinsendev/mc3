<?php

declare(strict_types=1);


namespace App\Component\DTO\Stats\Person;

use App\Component\DTO\Definition\DTOInterface;

/**
 * Class NestedFilmsInPersonStatsDTO
 * @package App\Component\DTO\Stats\Person
 */
class NestedFilmsInPersonStatsDTO implements DTOInterface
{
    private string $title;

    private string $uuid;

    private string $imdb;

    private int $releasedYear;

    private int $totalNumbersLength;

    private int $totalPersonNumbersLength;

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
    public function getTotalNumbersLength(): int
    {
        return $this->totalNumbersLength;
    }

    /**
     * @param int $totalNumbersLength
     */
    public function setTotalNumbersLength(int $totalNumbersLength): void
    {
        $this->totalNumbersLength = $totalNumbersLength;
    }

    /**
     * @return int
     */
    public function getTotalPersonNumbersLength(): int
    {
        return $this->totalPersonNumbersLength;
    }

    /**
     * @param int $totalPersonNumbersLength
     */
    public function setTotalPersonNumbersLength(int $totalPersonNumbersLength): void
    {
        $this->totalPersonNumbersLength = $totalPersonNumbersLength;
    }

}