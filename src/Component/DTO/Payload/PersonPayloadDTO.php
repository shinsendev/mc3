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
    private array $relatedNumbersByProfession = [];
    private array $relatedPersonsByProfession = [];
    private int $averageShotLength = 0;
    private array $presenceInFilms = [];

    private $works;

    private $performancesStats;

    private $structuresStats;

    private $completenessStats;

    private $sourcesStats;

    private $diegeticStats;

    private $topicsStats;

    private $exoticismsStats;

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
     * @return NumberNestedInPersonDTO[]
     */
    public function getRelatedNumbersByProfession(): array
    {
        return $this->relatedNumbersByProfession;
    }

    /**
     * @param NumberNestedInPersonDTO[] $relatedNumbersByProfession
     */
    public function setRelatedNumbersByProfession(array $relatedNumbersByProfession): void
    {
        $this->relatedNumbersByProfession = $relatedNumbersByProfession;
    }

    /**
     * @return FilmNestedDTO[]
     */
    public function getRelatedFilms(): array
    {
        return $this->relatedFilms;
    }

    /**
     * @param FilmNestedDTO[] $relatedFilms
     */
    public function setRelatedFilms(array $relatedFilms): void
    {
        $this->relatedFilms = $relatedFilms;
    }

    /**
     * @return PersonNestedInPersonDTO[]
     */
    public function getRelatedPersonsByProfession(): array
    {
        return $this->relatedPersonsByProfession;
    }

    /**
     * @param PersonNestedInPersonDTO[] $relatedPersonsByProfession
     */
    public function setRelatedPersonsByProfession(array $relatedPersonsByProfession): void
    {
        $this->relatedPersonsByProfession = $relatedPersonsByProfession;
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

}