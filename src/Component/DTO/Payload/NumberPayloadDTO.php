<?php

declare(strict_types=1);


namespace App\Component\DTO\Payload;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Hierarchy\AbstractNumberDTO;

/**
 * @package App\Component\DTO
 * @ApiResource(
 *     shortName="number"
 * )
 */
class NumberPayloadDTO extends AbstractNumberDTO
{

}