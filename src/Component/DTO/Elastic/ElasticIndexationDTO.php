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
    /**
     * @var ElasticSongNestedDTO[]
     */
    private array $songsObject;

    // number
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
     * @return ElasticSongNestedDTO[]
     */
    public function getSongsObject(): array
    {
        return $this->songsObject;
    }

    /**
     * @param ElasticSongNestedDTO[] $songsObject
     */
    public function setSongsObject(array $songsObject): void
    {
        $this->songsObject = $songsObject;
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