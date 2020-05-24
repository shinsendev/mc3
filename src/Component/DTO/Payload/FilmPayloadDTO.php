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
}