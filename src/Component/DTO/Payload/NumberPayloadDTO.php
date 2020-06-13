<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\Number\NumberBackstageTrait;
use App\Component\DTO\Composition\Number\NumberDescriptionTrait;
use App\Component\DTO\Composition\Number\NumberIntertextualityTrait;
use App\Component\DTO\Composition\Number\NumberMusicAndDanceTrait;
use App\Component\DTO\Composition\Number\NumberThemeTrait;
use App\Component\DTO\Composition\UniqueDTOTrait;
use App\Component\DTO\Definition\DTOInterface;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="number"
 * )
 */
class NumberPayloadDTO implements DTOInterface
{
    use UniqueDTOTrait,
        NumberDescriptionTrait,
        NumberBackstageTrait,
        NumberThemeTrait,
        NumberMusicAndDanceTrait,
        NumberIntertextualityTrait;

    CONST NO_VALUE = 'NA';

}