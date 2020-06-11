<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\Number\NumberDescriptionTrait;
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
    use UniqueDTOTrait, NumberDescriptionTrait;

    CONST NO_VALUE = 'NA';

    // todo : refacto all parts in trait if first trait works

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
    private $dubbing = 'NA'; // from number, not an attribute

    /** @var array */
    private $tempo = []; // SongDTO or NestedSongDTO

    /** @var array */
    private $musicalStyles = []; // SongDTO or NestedSongDTO

    /** @var array */
    private $arrangers = []; // PersonNestedDTO

    /** @var array */
    private $danceDirector = []; // PersonNestedDTO

    /** @var array */
    private $danceEnsemble = []; // AttributeNestedDTO

    /** @var array */
    private $dancingType = []; // AttributeNestedDTO

    /** @var array */
    private $danceSubgenre = []; // AttributeNestedDTO

    /** @var array */
    private $danceContent = []; // AttributeNestedDTO

    // Intertextuality
    /** @var array */
    private $source = self::NO_VALUE; // AttributeNestedDTO

    /** @var array */
    private $quotation = []; // AttributeNestedDTO

}