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
    private string $title;
    private string $sample = self::NO_VALUE;
    private string $imdb = self::NO_VALUE;
    private array $directors = [];
    private array $studios = [];
    private int $productionYear = 0;
    private int $releasedYear = 0;
    private string $viaf = self::NO_VALUE;
    private string $stageshows = self::NO_VALUE;

    private string $remake = self::NO_VALUE;
    private array $adaptation = []; // AttributeNestedDTO, just one result


    // censorship
    /** @var array */
    private array $censorships = []; // AttributeNestedDTO[], many results
    private array $states = []; // AttributeNestedDTO[], many results
    private array $pca = []; // AttributeNestedDTO, just one result
    private array $legion = []; // AttributeNestedDTO, just one result
    private array $protestant = []; // AttributeNestedDTO, just one result
    private array $harrison = []; // AttributeNestedDTO, just one result
    private array $board = []; // AttributeNestedDTO, just one result

    // numbers
    private array $numbers = [];

    // stats
    private int $numbersRatio = 0; // Ratio number/total length
    private int $numbersLength = 0; // Running time for all numbers
    private int $averageNumberLength = 0;
    private int $globalAverageNumberLength = 0;
    private int $length = 0;

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
    public function getProductionYear(): int
    {
        return $this->productionYear;
    }

    /**
     * @param int $productionYear
     */
    public function setProductionYear(int $productionYear): void
    {
        $this->productionYear = $productionYear;
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
     * @return string
     */
    public function getViaf(): string
    {
        return $this->viaf;
    }

    /**
     * @param string $viaf
     */
    public function setViaf(string $viaf): void
    {
        $this->viaf = $viaf;
    }

    /**
     * @return string
     */
    public function getStageshows(): string
    {
        return $this->stageshows;
    }

    /**
     * @param string $stageshows
     */
    public function setStageshows(string $stageshows): void
    {
        $this->stageshows = $stageshows;
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
     * @return array
     */
    public function getAdaptation(): array
    {
        return $this->adaptation;
    }

    /**
     * @param array $adaptation
     */
    public function setAdaptation(array $adaptation): void
    {
        $this->adaptation = $adaptation;
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
     * @return array
     */
    public function getStates(): array
    {
        return $this->states;
    }

    /**
     * @param array $states
     */
    public function setStates(array $states): void
    {
        $this->states = $states;
    }

    /**
     * @return array
     */
    public function getPca(): array
    {
        return $this->pca;
    }

    /**
     * @param array $pca
     */
    public function setPca(array $pca): void
    {
        $this->pca = $pca;
    }

    /**
     * @return array
     */
    public function getLegion(): array
    {
        return $this->legion;
    }

    /**
     * @param array $legion
     */
    public function setLegion(array $legion): void
    {
        $this->legion = $legion;
    }

    /**
     * @return array
     */
    public function getProtestant(): array
    {
        return $this->protestant;
    }

    /**
     * @param array $protestant
     */
    public function setProtestant(array $protestant): void
    {
        $this->protestant = $protestant;
    }

    /**
     * @return array
     */
    public function getHarrison(): array
    {
        return $this->harrison;
    }

    /**
     * @param array $harrison
     */
    public function setHarrison(array $harrison): void
    {
        $this->harrison = $harrison;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param array $board
     */
    public function setBoard(array $board): void
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
     * @return int
     */
    public function getNumbersRatio(): int
    {
        return $this->numbersRatio;
    }

    /**
     * @param int $numbersRatio
     */
    public function setNumbersRatio(int $numbersRatio): void
    {
        $this->numbersRatio = $numbersRatio;
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

}