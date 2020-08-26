<?php


namespace App\Component\DTO\Export\Composition;

/**
 * Trait FilmCsvExportDTO
 * @package App\Component\DTO\Export\Composition
 */
trait FilmCsvExportDTO
{
    protected string $filmTitle;
    protected ?int $filmReleased = null;
    protected ?string $filmSample = null;
    protected ?string $filmDirectors = null;
    protected ?string $filmStudios = null;
    protected ?string $filmUuid = null;
    protected ?string $filmImdb = null;
    protected ?string $filmShows = null;
    protected ?string $filmRemake= null;
    protected ?string $filmPca = null;
    protected ?string $filmCensorships = null;
    protected ?string $filmStates = null;
    protected ?string $filmLegion = null;
    protected ?string $filmProtestant = null;
    protected ?string $filmHarrison = null;
    protected ?string $filmBoard = null;

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
    public function getFilmRemake(): ?string
    {
        return $this->filmRemake;
    }

    /**
     * @param string|null $filmRemake
     */
    public function setFilmRemake(?string $filmRemake): void
    {
        $this->filmRemake = $filmRemake;
    }

    /**
     * @return string|null
     */
    public function getFilmPca(): ?string
    {
        return $this->filmPca;
    }

    /**
     * @param string|null $filmPca
     */
    public function setFilmPca(?string $filmPca): void
    {
        $this->filmPca = $filmPca;
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
    public function getFilmStates(): ?string
    {
        return $this->filmStates;
    }

    /**
     * @param string|null $filmStates
     */
    public function setFilmStates(?string $filmStates): void
    {
        $this->filmStates = $filmStates;
    }

    /**
     * @return string|null
     */
    public function getFilmLegion(): ?string
    {
        return $this->filmLegion;
    }

    /**
     * @param string|null $filmLegion
     */
    public function setFilmLegion(?string $filmLegion): void
    {
        $this->filmLegion = $filmLegion;
    }

    /**
     * @return string|null
     */
    public function getFilmProtestant(): ?string
    {
        return $this->filmProtestant;
    }

    /**
     * @param string|null $filmProtestant
     */
    public function setFilmProtestant(?string $filmProtestant): void
    {
        $this->filmProtestant = $filmProtestant;
    }

    /**
     * @return string|null
     */
    public function getFilmHarrison(): ?string
    {
        return $this->filmHarrison;
    }

    /**
     * @param string|null $filmHarrison
     */
    public function setFilmHarrison(?string $filmHarrison): void
    {
        $this->filmHarrison = $filmHarrison;
    }

    /**
     * @return string|null
     */
    public function getFilmBoard(): ?string
    {
        return $this->filmBoard;
    }

    /**
     * @param string|null $filmBoard
     */
    public function setFilmBoard(?string $filmBoard): void
    {
        $this->filmBoard = $filmBoard;
    }

}