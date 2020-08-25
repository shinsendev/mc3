<?php

namespace App\Component\DTO\Export;

use App\Component\DTO\Definition\DTOInterface;

class CsvExportDTO implements DTOInterface
{
    // film data
    private string $filmTitle;
    private ?int $filmReleased = null;
    private ?string $filmSample = null;
    private ?string $filmDirectors = null;
    private ?string $filmStudios = null;
    private ?string $filmUuid = null;
    private ?string $filmImdb = null;
    private ?string $filmShows = null;
    private ?string $remake= null;
    private ?string $pca = null;
    private ?string $filmCensorships = null;
    private ?string $states = null;
    private ?string $legion = null;
    private ?string $protestant = null;
    private ?string $harrison = null;
    private ?string $board = null;


    // number data
    private string $numberTitle;
    private ?int $beginTc = null;
    private ?int $endTc = null;

    // song data (one song by number?)
    private ?string $songs = null;

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
     * @return int|null
     */
    public function getFilmReleased(): ?int
    {
        return $this->filmReleased;
    }

    /**
     * @param int|null $filmReleased
     */
    public function setFilmReleased(?int $filmReleased): void
    {
        $this->filmReleased = $filmReleased;
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
     * @return string|null
     */
    public function getFilmUuid(): ?string
    {
        return $this->filmUuid;
    }

    /**
     * @param string|null $filmUuid
     */
    public function setFilmUuid(?string $filmUuid): void
    {
        $this->filmUuid = $filmUuid;
    }

    /**
     * @return string|null
     */
    public function getFilmImdb(): ?string
    {
        return $this->filmImdb;
    }

    /**
     * @param string|null $filmImdb
     */
    public function setFilmImdb(?string $filmImdb): void
    {
        $this->filmImdb = $filmImdb;
    }

    /**
     * @return string|null
     */
    public function getFilmShows(): ?string
    {
        return $this->filmShows;
    }

    /**
     * @param string|null $filmShows
     */
    public function setFilmShows(?string $filmShows): void
    {
        $this->filmShows = $filmShows;
    }

    /**
     * @return string|null
     */
    public function getRemake(): ?string
    {
        return $this->remake;
    }

    /**
     * @param string|null $remake
     */
    public function setRemake(?string $remake): void
    {
        $this->remake = $remake;
    }

    /**
     * @return string|null
     */
    public function getPca(): ?string
    {
        return $this->pca;
    }

    /**
     * @param string|null $pca
     */
    public function setPca(?string $pca): void
    {
        $this->pca = $pca;
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
    public function getStates(): ?string
    {
        return $this->states;
    }

    /**
     * @param string|null $states
     */
    public function setStates(?string $states): void
    {
        $this->states = $states;
    }

    /**
     * @return string|null
     */
    public function getLegion(): ?string
    {
        return $this->legion;
    }

    /**
     * @param string|null $legion
     */
    public function setLegion(?string $legion): void
    {
        $this->legion = $legion;
    }

    /**
     * @return string|null
     */
    public function getProtestant(): ?string
    {
        return $this->protestant;
    }

    /**
     * @param string|null $protestant
     */
    public function setProtestant(?string $protestant): void
    {
        $this->protestant = $protestant;
    }

    /**
     * @return string|null
     */
    public function getHarrison(): ?string
    {
        return $this->harrison;
    }

    /**
     * @param string|null $harrison
     */
    public function setHarrison(?string $harrison): void
    {
        $this->harrison = $harrison;
    }

    /**
     * @return string|null
     */
    public function getBoard(): ?string
    {
        return $this->board;
    }

    /**
     * @param string|null $board
     */
    public function setBoard(?string $board): void
    {
        $this->board = $board;
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
//    private ?string $songTitle;
//    private ?array $songLyricists;
//    private ?array $songComposers;
//    private ?string $songType;

}