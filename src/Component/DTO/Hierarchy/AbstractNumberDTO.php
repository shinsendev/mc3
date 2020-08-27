<?php


namespace App\Component\DTO\Hierarchy;


use App\Component\DTO\Composition\Number\NumberBackstageTrait;
use App\Component\DTO\Composition\Number\NumberDescriptionTrait;
use App\Component\DTO\Composition\Number\NumberIntertextualityTrait;
use App\Component\DTO\Composition\Number\NumberMusicAndDanceTrait;
use App\Component\DTO\Composition\Number\NumberThemeTrait;
use App\Component\DTO\Definition\NumberPayloadInterface;

abstract class AbstractNumberDTO extends AbstractUniqueDTO implements NumberPayloadInterface
{
    use NumberDescriptionTrait,
        NumberBackstageTrait,
        NumberThemeTrait,
        NumberMusicAndDanceTrait,
        NumberIntertextualityTrait;

    CONST NO_VALUE = 'blank';
}