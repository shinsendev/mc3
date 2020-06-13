<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;


use App\Component\DTO\Payload\NumberPayloadDTO;

trait NumberBackstageTrait
{
    /** @var string */
    protected $spectators = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    protected $diegeticPerformance = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var string */
    protected $visibleMusicians = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /**
     * @return string
     */
    public function getSpectators(): string
    {
        return $this->spectators;
    }

    /**
     * @param string $spectators
     */
    public function setSpectators(string $spectators): void
    {
        $this->spectators = $spectators;
    }

    /**
     * @return string
     */
    public function getDiegeticPerformance(): string
    {
        return $this->diegeticPerformance;
    }

    /**
     * @param string $diegeticPerformance
     */
    public function setDiegeticPerformance(string $diegeticPerformance): void
    {
        $this->diegeticPerformance = $diegeticPerformance;
    }

    /**
     * @return string
     */
    public function getVisibleMusicians(): string
    {
        return $this->visibleMusicians;
    }

    /**
     * @param string $visibleMusicians
     */
    public function setVisibleMusicians(string $visibleMusicians): void
    {
        $this->visibleMusicians = $visibleMusicians;
    }

}