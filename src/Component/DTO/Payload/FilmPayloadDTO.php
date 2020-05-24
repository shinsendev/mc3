<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="film"
 * )
 */
class FilmPayloadDTO
{
    use UniqueDTOTrait;

    // general infos

    /** @var string */
    private $title;

    /** @var int */
    private $productionYear;

    /** @var int */
    private $releasedYear;

    /** @var string */
    private $imdb;

    /** @var string */
    private $viaf;

    /** @var bool */
    private $sample;

    // recycling

    /** @var bool */
    private $remake;

    /** @var array */
    private $censorships;

    /** @var string */
    private $stageshows;

    // todo : add adaptation from thesaurus
    /** @var  string */
    private $adaptation;

    // censorship
    /** @var string */
    private $pca;

    // numbers linked to the film
    /** @var array */
    private  $numbers;

    // stats
    /** @var int */
    private $numberRatio;

    /** @var int */
    private $averageNumberLength;

    /** @var int */
    private $globalAverageNumberLength;

    /** @var int */
    private $numbersLength;

    /** @var int */
    private $length;

    private $globalNumbersLength;
    // timeline dataviz data
    // todo : add dataviz

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImdb()
    {
        return $this->imdb;
    }

    /**
     * @param mixed $imdb
     */
    public function setImdb($imdb): void
    {
        $this->imdb = $imdb;
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
     * @return bool
     */
    public function isSample(): bool
    {
        return $this->sample;
    }

    /**
     * @param bool $sample
     */
    public function setSample(bool $sample): void
    {
        $this->sample = $sample;
    }

    /**
     * @return bool
     */
    public function isRemake(): bool
    {
        return $this->remake;
    }

    /**
     * @param bool $remake
     */
    public function setRemake(bool $remake): void
    {
        $this->remake = $remake;
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
    public function getAdaptation(): string
    {
        return $this->adaptation;
    }

    /**
     * @param string $adaptation
     */
    public function setAdaptation(string $adaptation): void
    {
        $this->adaptation = $adaptation;
    }

    /**
     * @return string
     */
    public function getPca(): string
    {
        return $this->pca;
    }

    /**
     * @param string $pca
     */
    public function setPca(string $pca): void
    {
        $this->pca = $pca;
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
     * @return mixed
     */
    public function getGlobalNumbersLength()
    {
        return $this->globalNumbersLength;
    }

    /**
     * @param mixed $globalNumbersLength
     */
    public function setGlobalNumbersLength($globalNumbersLength): void
    {
        $this->globalNumbersLength = $globalNumbersLength;
    }
    
}