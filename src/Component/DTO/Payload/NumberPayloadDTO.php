<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Composition\Number\NumberBackstageTrait;
use App\Component\DTO\Composition\Number\NumberDescriptionTrait;
use App\Component\DTO\Composition\Number\NumberIntertextualityTrait;
use App\Component\DTO\Composition\Number\NumberMusicAndDanceTrait;
use App\Component\DTO\Composition\Number\NumberThemeTrait;
use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;

/**
 * Class NarrativeDTO
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="number"
 * )
 */
class NumberPayloadDTO extends AbstractUniqueDTO implements DTOInterface
{
    use NumberDescriptionTrait,
        NumberBackstageTrait,
        NumberThemeTrait,
        NumberMusicAndDanceTrait,
        NumberIntertextualityTrait;

    CONST NO_VALUE = 'blank';

}