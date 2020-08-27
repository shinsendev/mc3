<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\Hierarchy\AbstractNumberHydrator;

class NumberPayloadHydrator extends AbstractNumberHydrator implements HydratorDTOInterface
{

}