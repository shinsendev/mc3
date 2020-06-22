<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="person"
 * )
 */
class PersonPayloadDTO extends AbstractUniqueDTO
{
    CONST NO_VALUE = 'blank';

    /** @var string */
    private $fullname = self::NO_VALUE;

    /** @var string */
    private $gender = self::NO_VALUE;

    /** @var string */
    private $type= self::NO_VALUE; // group or person

    /** @var string */
    private $viaf = self::NO_VALUE;

    private $works;

    private $relatedFilms; // title, released data, total length of the numbers in the film,  total length of the numbers with person in the film, ratio is computed on client side

    private $relatedNumbersByProfession;

    private $relatedPersonsByProfession;

    // some stats // possible to preload, only if a data is changed the data is changed // person Stats
    private $averageShotLength;

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

}