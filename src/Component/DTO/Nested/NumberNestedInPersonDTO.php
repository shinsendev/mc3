<?php

declare(strict_types=1);

namespace App\Component\DTO\Nested;

use App\Component\DTO\Hierarchy\AbstractDTO;
use App\Component\Model\ModelConstants;

/**
 * Class NumberNestedDTO
 * @package App\Component\DTO\Nested
 */
class NumberNestedInPersonDTO extends AbstractDTO
{
    private string $title;
    private string $uuid;
    private string $filmTitle;
    private string $filmUuid;
    private string $filmImdb;
    private int $filmReleasedYear = 0;
    private string $profession = ModelConstants::NO_DATA;

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
    public function getFilmTitle(): string
    {
        return $this->filmTitle;
    }

    /**
     * @param string $filmTitle
     */
    public function setFilmTitle(string $filmTitle): void
    {
        $this->filmTitle = $filmTitle;
    }

    /**
     * @return string
     */
    public function getFilmUuid(): string
    {
        return $this->filmUuid;
    }

    /**
     * @param string $filmUuid
     */
    public function setFilmUuid(string $filmUuid): void
    {
        $this->filmUuid = $filmUuid;
    }

    /**
     * @return string
     */
    public function getFilmImdb(): string
    {
        return $this->filmImdb;
    }

    /**
     * @param string $filmImdb
     */
    public function setFilmImdb(string $filmImdb): void
    {
        $this->filmImdb = $filmImdb;
    }

    /**
     * @return int
     */
    public function getFilmReleasedYear(): int
    {
        return $this->filmReleasedYear;
    }

    /**
     * @param int $filmReleasedYear
     */
    public function setFilmReleasedYear(int $filmReleasedYear): void
    {
        $this->filmReleasedYear = $filmReleasedYear;
    }

    /**
     * @return string
     */
    public function getProfession(): string
    {
        return $this->profession;
    }

    /**
     * @param string $profession
     */
    public function setProfession(string $profession): void
    {
        $this->profession = $profession;
    }

}