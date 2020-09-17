<?php

namespace App\Component\DTO\Export\Nested;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

class ExportableSongNestedDTO extends AbstractUniqueDTO
{
    /** @var string */
    private $title;

    /** @var integer */
    private $year = 0;

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