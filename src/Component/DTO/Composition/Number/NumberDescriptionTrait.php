<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;

trait NumberDescriptionTrait
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $film;

    /** @var string */
    protected $startingTc = 0;

    /** @var string */
    protected $endingTc = 0;

    /** @var string */
    protected $beginning = NumberPayloadDTO::NO_VALUE;

    /** @var string */
    protected $ending = NumberPayloadDTO::NO_VALUE;

    /** @var array */
    protected $completeness = []; // AttributeNestedDTO

    /** @var string */
    protected $completenessOptions = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    protected $structure = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var int */
    protected $shots = 0;

    /** @var int */
    protected $averageShotLength;

    /** @var string */
    protected $performance = NumberPayloadDTO::NO_VALUE; // one choice

    /** @var array */
    protected $performers = []; // PersonNestedDTO

    /** @var string */
    protected $cast = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var array */
    protected $noParticipationStars = [];

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
    public function getFilm(): string
    {
        return $this->film;
    }

    /**
     * @param string $film
     */
    public function setFilm(string $film): void
    {
        $this->film = $film;
    }

    /**
     * @return string
     */
    public function getStartingTc(): string
    {
        return $this->startingTc;
    }

    /**
     * @param string $startingTc
     */
    public function setStartingTc(string $startingTc): void
    {
        $this->startingTc = $startingTc;
    }

    /**
     * @return string
     */
    public function getEndingTc(): string
    {
        return $this->endingTc;
    }

    /**
     * @param string $endingTc
     */
    public function setEndingTc(string $endingTc): void
    {
        $this->endingTc = $endingTc;
    }

    /**
     * @return string
     */
    public function getBeginning(): string
    {
        return $this->beginning;
    }

    /**
     * @param string $beginning
     */
    public function setBeginning(string $beginning): void
    {
        $this->beginning = $beginning;
    }

    /**
     * @return string
     */
    public function getEnding(): string
    {
        return $this->ending;
    }

    /**
     * @param string $ending
     */
    public function setEnding(string $ending): void
    {
        $this->ending = $ending;
    }

    /**
     * @return array
     */
    public function getCompleteness(): array
    {
        return $this->completeness;
    }

    /**
     * @param array $completeness
     */
    public function setCompleteness(array $completeness): void
    {
        $this->completeness = $completeness;
    }

    /**
     * @return string
     */
    public function getCompletenessOptions(): string
    {
        return $this->completenessOptions;
    }

    /**
     * @param string $completenessOptions
     */
    public function setCompletenessOptions(string $completenessOptions): void
    {
        $this->completenessOptions = $completenessOptions;
    }

    /**
     * @return string
     */
    public function getStructure(): string
    {
        return $this->structure;
    }

    /**
     * @param string $structure
     */
    public function setStructure(string $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return int
     */
    public function getShots(): int
    {
        return $this->shots;
    }

    /**
     * @param int $shots
     */
    public function setShots(int $shots): void
    {
        $this->shots = $shots;
    }

    /**
     * @return int
     */
    public function getAverageShotLength(): int
    {
        return $this->averageShotLength;
    }

    /**
     * @param int $averageShotLength
     */
    public function setAverageShotLength(int $averageShotLength): void
    {
        $this->averageShotLength = $averageShotLength;
    }

    /**
     * @return string
     */
    public function getPerformance(): string
    {
        return $this->performance;
    }

    /**
     * @param string $performance
     */
    public function setPerformance(string $performance): void
    {
        $this->performance = $performance;
    }

    /**
     * @return array
     */
    public function getPerformers(): array
    {
        return $this->performers;
    }

    /**
     * @param array $performers
     */
    public function setPerformers(array $performers): void
    {
        $this->performers = $performers;
    }

    /**
     * @return string
     */
    public function getCast(): string
    {
        return $this->cast;
    }

    /**
     * @param string $cast
     */
    public function setCast(string $cast): void
    {
        $this->cast = $cast;
    }

    /**
     * @return array
     */
    public function getNoParticipationStars(): array
    {
        return $this->noParticipationStars;
    }

    /**
     * @param array $noParticipationStars
     */
    public function setNoParticipationStars(array $noParticipationStars): void
    {
        $this->noParticipationStars = $noParticipationStars;
    } // PersonNestedDTO (figurants)
}