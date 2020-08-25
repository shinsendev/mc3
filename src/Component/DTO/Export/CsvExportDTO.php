<?php

namespace App\Component\DTO\Export;

use App\Component\DTO\Definition\DTOInterface;

class CsvExportDTO implements DTOInterface
{
    // film data
    private string $filmTitle;
    private ?int $filmReleased = null;
    private ?string $filmCensorships = null;
    private ?string $filmSample = null;
    private ?string $filmDirectors = null;
    private ?string $filmStudios = null;

    // number data
    private string $numberTitle;
    private ?int $beginTc = null;
    private ?int $endTc = null;

    // song data (one song by number?)
    private ?string $songs = null;

//    private ?string $songTitle;
//    private ?array $songLyricists;
//    private ?array $songComposers;
//    private ?string $songType;

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
    public function getNumberTitle(): string
    {
        return $this->numberTitle;
    }

    /**
     * @param string $numberTitle
     */
    public function setNumberTitle(string $numberTitle): void
    {
        $this->numberTitle = $numberTitle;
    }

    /**
     * @return mixed
     */
    public function getFilmReleased()
    {
        return $this->filmReleased;
    }

    /**
     * @param mixed $filmReleased
     */
    public function setFilmReleased($filmReleased): void
    {
        $this->filmReleased = $filmReleased;
    }

    /**
     * @return string|null
     */
    public function getFilmCensorships(): ?string
    {
        return $this->filmCensorships;
    }

    /**
     * @param string|null $filmCensorships
     */
    public function setFilmCensorships(?string $filmCensorships): void
    {
        $this->filmCensorships = $filmCensorships;
    }

    /**
     * @return string|null
     */
    public function getFilmSample(): ?string
    {
        return $this->filmSample;
    }

    /**
     * @param string|null $filmSample
     */
    public function setFilmSample(?string $filmSample): void
    {
        $this->filmSample = $filmSample;
    }

    /**
     * @return string|null
     */
    public function getFilmDirectors(): ?string
    {
        return $this->filmDirectors;
    }

    /**
     * @param string|null $filmDirectors
     */
    public function setFilmDirectors(?string $filmDirectors): void
    {
        $this->filmDirectors = $filmDirectors;
    }

    /**
     * @return string|null
     */
    public function getFilmStudios(): ?string
    {
        return $this->filmStudios;
    }

    /**
     * @param string|null $filmStudios
     */
    public function setFilmStudios(?string $filmStudios): void
    {
        $this->filmStudios = $filmStudios;
    }

    /**
     * @return int|null
     */
    public function getBeginTc(): ?int
    {
        return $this->beginTc;
    }

    /**
     * @param int|null $beginTc
     */
    public function setBeginTc(?int $beginTc): void
    {
        $this->beginTc = $beginTc;
    }

    /**
     * @return int|null
     */
    public function getEndTc(): ?int
    {
        return $this->endTc;
    }

    /**
     * @param int|null $endTc
     */
    public function setEndTc(?int $endTc): void
    {
        $this->endTc = $endTc;
    }

    /**
     * @return string|null
     */
    public function getSongs(): ?string
    {
        return $this->songs;
    }

    /**
     * @param string|null $songs
     */
    public function setSongs(?string $songs): void
    {
        $this->songs = $songs;
    }

}