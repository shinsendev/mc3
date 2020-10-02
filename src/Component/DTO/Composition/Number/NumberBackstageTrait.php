<?php

declare(strict_types=1);

namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;
use Symfony\Component\Serializer\Annotation\Groups;

/**+
 * Trait NumberBackstageTrait
 * @package App\Component\DTO\Composition\Number
 */
trait NumberBackstageTrait
{
    /**
     * @Groups({"export"})
     */
    protected array $spectators = []; // AttributeNestedDTO - one value

    /**
     * @Groups({"export"})
     */
    protected array $diegeticPerformance = []; // AttributeNestedDTO - one value

    /**
     * @Groups({"export"})
     */
    protected array $visibleMusicians = []; // AttributeNestedDTO - one value

    /**
     * @return array
     */
    public function getSpectators(): array
    {
        return $this->spectators;
    }

    /**
     * @param array $spectators
     */
    public function setSpectators(array $spectators): void
    {
        $this->spectators = $spectators;
    }

    /**
     * @return array
     */
    public function getDiegeticPerformance(): array
    {
        return $this->diegeticPerformance;
    }

    /**
     * @param array $diegeticPerformance
     */
    public function setDiegeticPerformance(array $diegeticPerformance): void
    {
        $this->diegeticPerformance = $diegeticPerformance;
    }

    /**
     * @return array
     */
    public function getVisibleMusicians(): array
    {
        return $this->visibleMusicians;
    }

    /**
     * @param array $visibleMusicians
     */
    public function setVisibleMusicians(array $visibleMusicians): void
    {
        $this->visibleMusicians = $visibleMusicians;
    }

}
