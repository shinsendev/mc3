<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class FilmPayloadDTO
 *
 */
class FilmPayloadDTO extends AbstractUniqueDTO
{
    CONST NO_VALUE = 'NA';

    // general infos
    /** @var string */
    private $title;

    /** @var string */
    private $sample = self::NO_VALUE;

    /** @var string */
    private $imdb = self::NO_VALUE;

    /** @var array */
    private $directors = [];

    /** @var array */
    private $studios = [];

    /** @var int */
    private $productionYear = 0;

    /** @var int */
    private $releasedYear = 0;

    /** @var string */
    private $viaf = self::NO_VALUE;


    // recycling
    /** @var string */
    private $remake = self::NO_VALUE;

    /** @var string */
    private $stageshows = self::NO_VALUE;

    /** @var  string */
    private $adaptation = self::NO_VALUE;


    // censorship
    /** @var array */
    private $censorships = [];

    /** @var string */
    private $pca = self::NO_VALUE;

    /** @var array */
    private $states = [];

    /** @var string */
    private $legion = self::NO_VALUE;

    /** @var string */
    private $protestant = self::NO_VALUE;

    /** @var string */
    private $harrison = self::NO_VALUE;

    /** @var string */
    private $board = self::NO_VALUE;

    /** @var array */
    private  $numbers = [];

    // stats
    /** @var int */
    private $numberRatio = 0;

    /** @var int */
    private $numbersLength = 0;

    /** @var int */
    private $averageNumberLength = 0;

    /** @var int */
    private $globalAverageNumberLength = 0;

    /** @var int */
    private $length = 0;

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
    public function getProductionYear(): int
    {
        return $this->productionYear;
    }

    /**
     * @param int $productionYear
     */
    public function setProductionYear($productionYear): void
    {
        $this->productionYear = $productionYear;
    }


    /**
     * @return int
     */
    public function getReleasedYear():int
    {
        return $this->releasedYear;
    }

    /**
     * @param int $releasedYear
     */
    public function setReleasedYear($releasedYear): void
    {
        $this->releasedYear = $releasedYear;
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
     * @return string|void
     */
    public function getViaf()
    {
        return $this->viaf;
    }

    /**
     * @param string|void $viaf
     */
    public function setViaf($viaf): void
    {
        $this->viaf = $viaf;
    }

    /**
     * @return string
     */
    public function getRemake(): string
    {
        return $this->remake;
    }

    /**
     * @param string $remake
     */
    public function setRemake(string $remake): void
    {
        $this->remake = $remake;
    }

    /**
     * @return string
     */
    public function getStageshows()
    {
        return $this->stageshows;
    }

    /**
     * @param string $stageshows
     */
    public function setStageshows($stageshows): void
    {
        $this->stageshows = $stageshows;
    }

    /**
     * @return string
     */
    public function getAdaptation()
    {
        return $this->adaptation;
    }

    /**
     * @param string $adaptation
     */
    public function setAdaptation($adaptation): void
    {
        $this->adaptation = $adaptation;
    }

    /**
     * @return string|void
     */
    public function getPca()
    {
        return $this->pca;
    }

    /**
     * @param string|void $pca
     */
    public function setPca($pca): void
    {
        $this->pca = $pca;
    }

    /**
     * @return array
     */
    public function getDirectors(): array
    {
        return $this->directors;
    }

    /**
     * @param array $directors
     */
    public function setDirectors(array $directors): void
    {
        $this->directors = $directors;
    }

    /**
     * @return array
     */
    public function getStudios(): array
    {
        return $this->studios;
    }

    /**
     * @param array $studios
     */
    public function setStudios(array $studios): void
    {
        $this->studios = $studios;
    }

    /**
     * @return int
     */
    public function getAverageNumberLength(): int
    {
        return $this->averageNumberLength;
    }

    /**
     * @param int $averageNumberLength
     */
    public function setAverageNumberLength(int $averageNumberLength): void
    {
        $this->averageNumberLength = $averageNumberLength;
    }

    /**
     * @return int
     */
    public function getGlobalAverageNumberLength(): int
    {
        return $this->globalAverageNumberLength;
    }

    /**
     * @param int $globalAverageNumberLength
     */
    public function setGlobalAverageNumberLength(int $globalAverageNumberLength): void
    {
        $this->globalAverageNumberLength = $globalAverageNumberLength;
    }

    /**
     * @return int
     */
    public function getNumbersLength(): int
    {
        return $this->numbersLength;
    }

    /**
     * @param int $numbersLength
     */
    public function setNumbersLength(int $numbersLength): void
    {
        $this->numbersLength = $numbersLength;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return array
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @param array $states
     */
    public function setStates($states): void
    {
        $this->states = $states;
    }

    /**
     * @return string
     */
    public function getLegion()
    {
        return $this->legion;
    }

    /**
     * @param string $legion
     */
    public function setLegion($legion): void
    {
        $this->legion = $legion;
    }

    /**
     * @return string
     */
    public function getProtestant()
    {
        return $this->protestant;
    }

    /**
     * @param string $protestant
     */
    public function setProtestant($protestant): void
    {
        $this->protestant = $protestant;
    }

    /**
     * @return string
     */
    public function getHarrison()
    {
        return $this->harrison;
    }

    /**
     * @param string $harrison
     */
    public function setHarrison($harrison): void
    {
        $this->harrison = $harrison;
    }

    /**
     * @return string
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param string $board
     */
    public function setBoard($board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getNumbers(): array
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
     * @return string
     */
    public function getSample(): string
    {
        return $this->sample;
    }

    /**
     * @param string $sample
     */
    public function setSample(string $sample): void
    {
        $this->sample = $sample;
    }

    /**
     * @return array
     */
    public function getCensorships(): array
    {
        return $this->censorships;
    }

    /**
     * @param array $censorships
     */
    public function setCensorships(array $censorships): void
    {
        $this->censorships = $censorships;
    }

    /**
     * @return int
     */
    public function getNumberRatio(): int
    {
        return $this->numberRatio;
    }

    /**
     * @param int $numberRatio
     */
    public function setNumberRatio(int $numberRatio): void
    {
        $this->numberRatio = $numberRatio;
    }

    // timeline dataviz data
    // todo : add dataviz

}