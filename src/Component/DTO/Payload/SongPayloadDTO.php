<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="song"
 * )
 */
class SongPayloadDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var integer */
    private $year = 0;

    /** @var string */
    private $externalId;

    /** @var array */
    private $numbers = [];

    /** @var array */
    private $films = [];

    /** @var array */
    private $songTypes = [];

    /** @var array  */
    private $lyricists = [];

    /** @var array  */
    private $composers = [];

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
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId(?string $externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return array
     */
    public function getNumbers(): ?array
    {
        return $this->numbers;
    }

    /**
     * @param array $numbers
     */
    public function setNumbers(array $numbers): void
    {
        $this->numbers = $numbers;
    }

    /**
     * @return array
     */
    public function getFilms(): ?array
    {
        return $this->films;
    }

    /**
     * @param array $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }

    /**
     * @return array
     */
    public function getSongTypes(): array
    {
        return $this->songTypes;
    }

    /**
     * @param array $songTypes
     */
    public function setSongTypes(array $songTypes): void
    {
        $this->songTypes = $songTypes;
    }

    /**
     * @return array
     */
    public function getLyricists(): array
    {
        return $this->lyricists;
    }

    /**
     * @param array $lyricists
     */
    public function setLyricists(array $lyricists): void
    {
        $this->lyricists = $lyricists;
    }

    /**
     * @return array
     */
    public function getComposers(): array
    {
        return $this->composers;
    }

    /**
     * @param array $composers
     */
    public function setComposers(array $composers): void
    {
        $this->composers = $composers;
    }

}