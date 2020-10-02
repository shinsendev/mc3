<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use Symfony\Component\Serializer\Annotation\Groups;

trait NumberDescriptionTrait
{
    /**
     * @Groups({"export"})
     */
    protected string $title;

    /**
     * @Groups({"export"})
     */
    protected string $film;

    /**
     * @Groups({"export"})
     */
    protected string $filmUuid = '';

    /**
     * @Groups({"export"})
     */
    protected int $releasedYear = 0;

    /**
     * @Groups({"export"})
     */
    protected int $startingTc = 0;

    /**
     * @Groups({"export"})
     */
    protected int $endingTc = 0;

    /**
     * @Groups({"export"})
     */
    protected int $shots = 0;

    /**
     * @Groups({"export"})
     */
    protected int $averageShotLength = 0;

    /**
     * @Groups({"export"})
     */
    protected int $reference = 0;

    // attributes
    /**
     * @Groups({"export"})
     */
    protected array $beginning = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $ending = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $completeness = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $completenessOption = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $structure = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $cast = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $performance = []; // AttributeNestedDTO - one choice

    // people
    /**
     * @Groups({"export"})
     */
    protected array $performers = []; // PersonNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $directors = []; // PersonNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $noParticipationStars = []; // PersonNestedDTO

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
    public function getFilmUuid(): string
    {
        return $this->filmUuid;
    }

    /**
     * @param string $filmUuid
     */
    public function setFilmUuid(string $filmUuid): void
    {
        $this->filmUuid = $filmUuid;
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
     * @return int
     */
    public function getStartingTc(): int
    {
        return $this->startingTc;
    }

    /**
     * @param int $startingTc
     */
    public function setStartingTc(int $startingTc): void
    {
        $this->startingTc = $startingTc;
    }

    /**
     * @return int
     */
    public function getEndingTc(): int
    {
        return $this->endingTc;
    }

    /**
     * @param int $endingTc
     */
    public function setEndingTc(int $endingTc): void
    {
        $this->endingTc = $endingTc;
    }

    /**
     * @return array
     */
    public function getBeginning(): array
    {
        return $this->beginning;
    }

    /**
     * @param array $beginning
     */
    public function setBeginning(array $beginning): void
    {
        $this->beginning = $beginning;
    }

    /**
     * @return array
     */
    public function getEnding(): array
    {
        return $this->ending;
    }

    /**
     * @param array $ending
     */
    public function setEnding(array $ending): void
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
     * @return array
     */
    public function getCompletenessOption(): array
    {
        return $this->completenessOption;
    }

    /**
     * @param array $completenessOption
     */
    public function setCompletenessOption(array $completenessOption): void
    {
        $this->completenessOption = $completenessOption;
    }

    /**
     * @return array
     */
    public function getStructure(): array
    {
        return $this->structure;
    }

    /**
     * @param array $structure
     */
    public function setStructure(array $structure): void
    {
        $this->structure = $structure;
    }

    /**
     * @return array
     */
    public function getCast(): array
    {
        return $this->cast;
    }

    /**
     * @param array $cast
     */
    public function setCast(array $cast): void
    {
        $this->cast = $cast;
    }

    /**
     * @return array
     */
    public function getPerformance(): array
    {
        return $this->performance;
    }

    /**
     * @param array $performance
     */
    public function setPerformance(array $performance): void
    {
        $this->performance = $performance;
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
    }

    /**
     * @return int
     */
    public function getReference(): int
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     */
    public function setReference(int $reference): void
    {
        $this->reference = $reference;
    }

}
