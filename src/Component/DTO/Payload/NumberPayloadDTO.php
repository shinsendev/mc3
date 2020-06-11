<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\UniqueDTOTrait;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="number"
 * )
 */
class NumberPayloadDTO
{
    use UniqueDTOTrait;

    CONST NO_VALUE = 'NA';

    // description
    /** @var string */
    private $title;

    /** @var string */
    private $film;

    /** @var string */
    private $startingTc = 0;

    /** @var string */
    private $endingTc = 0;

    /** @var string */
    private $beginning = self::NO_VALUE;

    /** @var string */
    private $ending = self::NO_VALUE;

    /** @var array */
    private $completeness = []; // AttributeNestedDTO

    /** @var string */
    private $completenessOptions = self::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    private $structure = self::NO_VALUE; // AttributeNestedDTO

    /** @var int */
    private $shots = 0;

    /** @var int */
    private $averageShotLength;

    /** @var string */
    private $performance = self::NO_VALUE; // one choice

    /** @var array */
    private $performers = []; // PersonNestedDTO

    /** @var string */
    private $cast = self::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    private $noParticipationStars; // ??? what is the data source ?


    // backstage

    /** @var string */
    private $spectators = self::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    private $diegeticPerformance = self::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    private $visibleMusicians = self::NO_VALUE; // AttributeNestedDTO


    // themes

    /** @var array */
    private $topic = []; // AttributeNestedDTO

    /** @var array */
    private $diegeticPlace = []; // AttributeNestedDTO

    /** @var array */
    private $imaginaryPlace = []; // AttributeNestedDTO

    /** @var array */
    private $ethnicStereotypes = []; // AttributeNestedDTO

    /** @var array */
    private $exoticism = []; // AttributeNestedDTO


    // Music & dance

    /** @var array */
    private $song = []; // SongDTO or NestedSongDTO

    private $musicalEnsemble = []; //

    /** @var string */
    private $dubbing = 'NA';

    private $tempo;

    private $musicalStyles;

    private $arrangers;

    private $danceDirector;

    private $danceEnsemble;

    private $dancingType;

    private $danceSubgenre;

    private $content;

    // Intertextuality

    private $source;

    private $sourceDetails;

    private $quotation;

    private $references;


}