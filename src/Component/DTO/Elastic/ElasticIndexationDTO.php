<?php


namespace App\Component\DTO\Elastic;

use App\Component\DTO\Hierarchy\AbstractNumberDTO;
use App\Component\DTO\Nested\Elastic\ElasticFilmNestedDTO;
use App\Component\DTO\Nested\Elastic\ElasticSongNestedDTO;

class ElasticIndexationDTO extends AbstractNumberDTO
{
    // films
    // todo : create a Nested Film for elastic
    private ElasticFilmNestedDTO $filmObject;

    // song
    private ElasticSongNestedDTO $songObject;

    // number
    // average shot length
    private ?string $releasedYearInDate = null;

    /**
     * @return ElasticFilmNestedDTO
     */
    public function getFilmObject(): ElasticFilmNestedDTO
    {
        return $this->filmObject;
    }

    /**
     * @param ElasticFilmNestedDTO $filmObject
     */
    public function setFilmObject(ElasticFilmNestedDTO $filmObject): void
    {
        $this->filmObject = $filmObject;
    }

    /**
     * @return ElasticSongNestedDTO
     */
    public function getSongObject(): ElasticSongNestedDTO
    {
        return $this->songObject;
    }

    /**
     * @param ElasticSongNestedDTO $songObject
     */
    public function setSongObject(ElasticSongNestedDTO $songObject): void
    {
        $this->songObject = $songObject;
    }

    /**
     * @return string|null
     */
    public function getReleasedYearInDate(): ?string
    {
        return $this->releasedYearInDate;
    }

    /**
     * @param string|null $releasedYearInDate
     */
    public function setReleasedYearInDate(?string $releasedYearInDate): void
    {
        $this->releasedYearInDate = $releasedYearInDate;
    }

}