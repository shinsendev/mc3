<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\FilmNestedDTO;
use App\Component\DTO\Nested\NumberNestedInPersonDTO;
use App\Component\DTO\Nested\PersonNestedInPersonDTO;
use App\Component\Hydrator\Strategy\NestedFilmHydrator;
use App\Component\Hydrator\Strategy\NestedFilmInPersonHydrator;
use App\Entity\Person;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="person"
 * )
 */
class PersonPayloadDTO extends AbstractUniqueDTO
{
    CONST GROUP = 'group';
    CONST PERSON = 'person';
    CONST NO_VALUE = 'blank';

    private string $fullname = self::NO_VALUE;
    private string $gender = self::NO_VALUE;
    private string $type= self::NO_VALUE; // group or person
    private string $viaf = self::NO_VALUE;

    private array $relatedFilms = [];
    private array $relatedNumbers = [];

    // co-workers
    private array $choregraphers = [];
    private array $composers = [];
    private array $lyricists = [];

    // presence stats
    private int $averageShotLength = 0;
    private array $presenceInFilms = [];

    // profession the person has done
    private array $professions = [];

    // melviz stats
    private array $comparisons = [];

    /**
     * @return string
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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
     * @return array
     */
    public function getRelatedFilms(): array
    {
        return $this->relatedFilms;
    }

    /**
     * @param array $relatedFilms
     */
    public function setRelatedFilms(array $relatedFilms): void
    {
        $this->relatedFilms = $relatedFilms;
    }

    /**
     * PersonNestedInPersonDTO
     * @return array
     */
    public function getRelatedNumbers(): array
    {
        return $this->relatedNumbers;
    }

    /**
     * @param array $relatedNumbers
     */
    public function setRelatedNumbers(array $relatedNumbers): void
    {
        $this->relatedNumbers = $relatedNumbers;
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
    public function getPresenceInFilms(): array
    {
        return $this->presenceInFilms;
    }

    /**
     * @param array $presenceInFilms
     */
    public function setPresenceInFilms(array $presenceInFilms): void
    {
        $this->presenceInFilms = $presenceInFilms;
    }

    /**
     * @return array
     */
    public function getChoregraphers(): array
    {
        return $this->choregraphers;
    }

    /**
     * @param array $choregraphers
     */
    public function setChoregraphers(array $choregraphers): void
    {
        $this->choregraphers = $choregraphers;
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
    public function getProfessions(): array
    {
        return $this->professions;
    }

    /**
     * @param array $professions
     */
    public function setProfessions(array $professions): void
    {
        $this->professions = $professions;
    }

    /**
     * @return array
     */
    public function getComparisons(): array
    {
        return $this->comparisons;
    }

    /**
     * @param array $comparisons
     */
    public function setComparisons(array $comparisons): void
    {
        $this->comparisons = $comparisons;
    }
    
}