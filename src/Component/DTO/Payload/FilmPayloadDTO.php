<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\PersonNestedDTO;

/**
 * Class FilmPayloadDTO
 *
 */
class FilmPayloadDTO extends AbstractUniqueDTO
{
    // general infos
    /** @var string */
    private $title;

    /** @var void|string */
    private $imdb;

    /** @var void|int */
    private $productionYear;

    /** @var void|int */
    private $releasedYear;

    /** @var void|string */
    private $viaf;

    /** @var void|bool */
    private $sample;

    // recycling

    /** @var void|bool */
    private $remake;

    /** @var void|array */
    private $censorships;

    /** @var void|string */
    private $stageshows;

    // todo : add adaptation from thesaurus, is it a many to many?
    /** @var  void|string */
    private $adaptation;

    // censorship
    /** @var void|string */
    private $pca;

    /** @var void|array */
    private $states;

    /** @var void|string */
    private $legion;

    /** @var void|string */
    private $protestant;

    /** @var void|string */
    private $harrison;

    /** @var void|string */
    private $board;

    // numbers linked to the film
    /** @var void|array */
    private  $numbers;

    // persons
    /** @var void|PersonNestedDTO[] */
    private $directors;

    // studios
    /** @var void|array */
    private $studios;

    // stats
    /** @var void|int */
    private $numberRatio;

    /** @var void|int */
    private $averageNumberLength;

    /** @var void|int */
    private $globalAverageNumberLength;

    /** @var void|int */
    private $numbersLength;

    /** @var void|int */
    private $length;

    /** @var void|int */
    private $globalNumbersLength;

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
     * @return int|void
     */
    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    /**
     * @param int|void $productionYear
     */
    public function setProductionYear($productionYear): void
    {
        $this->productionYear = $productionYear;
    }


    /**
     * @return int|void
     */
    public function getReleasedYear()
    {
        return $this->releasedYear;
    }

    /**
     * @param int|void $releasedYear
     */
    public function setReleasedYear($releasedYear): void
    {
        $this->releasedYear = $releasedYear;
    }

    /**
     * @return string
     */
    public function getImdb(): ?string
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
     * @return bool|void
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * @param bool|void $sample
     */
    public function setSample($sample): void
    {
        $this->sample = $sample;
    }

    /**
     * @return bool|void
     */
    public function getRemake()
    {
        return $this->remake;
    }

    /**
     * @param bool|void $remake
     */
    public function setRemake($remake): void
    {
        $this->remake = $remake;
    }

    /**
     * @return array
     */
    public function getCensorships(): ?array
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
     * @return string|void
     */
    public function getStageshows()
    {
        return $this->stageshows;
    }

    /**
     * @param string|void $stageshows
     */
    public function setStageshows($stageshows): void
    {
        $this->stageshows = $stageshows;
    }

    /**
     * @return string|void
     */
    public function getAdaptation()
    {
        return $this->adaptation;
    }

    /**
     * @param string|void $adaptation
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
     * @return PersonNestedDTO[]
     */
    public function getDirectors(): ?array
    {
        return $this->directors;
    }

    /**
     * @param PersonNestedDTO[] $directors
     */
    public function setDirectors(array $directors): void
    {
        $this->directors = $directors;
    }

    /**
     * @return array
     */
    public function getStudios(): ?array
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
    public function getNumberRatio(): ?int
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
    public function getAverageNumberLength(): ?int
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
    public function getGlobalAverageNumberLength(): ?int
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
    public function getNumbersLength(): ?int
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
    public function getLength(): ?int
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
     * @return int
     */
    public function getGlobalNumbersLength(): ?int
    {
        return $this->globalNumbersLength;
    }

    /**
     * @param int $globalNumbersLength
     */
    public function setGlobalNumbersLength(int $globalNumbersLength): void
    {
        $this->globalNumbersLength = $globalNumbersLength;
    }

    /**
     * @return array|void
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * @param array|void $states
     */
    public function setStates($states): void
    {
        $this->states = $states;
    }

    /**
     * @return string|void
     */
    public function getLegion()
    {
        return $this->legion;
    }

    /**
     * @param string|void $legion
     */
    public function setLegion($legion): void
    {
        $this->legion = $legion;
    }

    /**
     * @return string|void
     */
    public function getProtestant()
    {
        return $this->protestant;
    }

    /**
     * @param string|void $protestant
     */
    public function setProtestant($protestant): void
    {
        $this->protestant = $protestant;
    }

    /**
     * @return string|void
     */
    public function getHarrison()
    {
        return $this->harrison;
    }

    /**
     * @param string|void $harrison
     */
    public function setHarrison($harrison): void
    {
        $this->harrison = $harrison;
    }

    /**
     * @return string|void
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @param string|void $board
     */
    public function setBoard($board): void
    {
        $this->board = $board;
    }

    // timeline dataviz data
    // todo : add dataviz


}