<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;


trait NumberThemeTrait
{
    /** @var array */
    protected $topic = []; // AttributeNestedDTO

    /** @var array */
    protected $diegeticPlace = []; // AttributeNestedDTO

    /** @var array */
    protected $imaginaryPlace = []; // AttributeNestedDTO

    /** @var array */
    protected $ethnicStereotypes = []; // AttributeNestedDTO

    /** @var array */
    protected $exoticism = []; // AttributeNestedDTO

    /**
     * @return array
     */
    public function getTopic(): array
    {
        return $this->topic;
    }

    /**
     * @param array $topic
     */
    public function setTopic(array $topic): void
    {
        $this->topic = $topic;
    }

    /**
     * @return array
     */
    public function getDiegeticPlace(): array
    {
        return $this->diegeticPlace;
    }

    /**
     * @param array $diegeticPlace
     */
    public function setDiegeticPlace(array $diegeticPlace): void
    {
        $this->diegeticPlace = $diegeticPlace;
    }

    /**
     * @return array
     */
    public function getImaginaryPlace(): array
    {
        return $this->imaginaryPlace;
    }

    /**
     * @param array $imaginaryPlace
     */
    public function setImaginaryPlace(array $imaginaryPlace): void
    {
        $this->imaginaryPlace = $imaginaryPlace;
    }

    /**
     * @return array
     */
    public function getEthnicStereotypes(): array
    {
        return $this->ethnicStereotypes;
    }

    /**
     * @param array $ethnicStereotypes
     */
    public function setEthnicStereotypes(array $ethnicStereotypes): void
    {
        $this->ethnicStereotypes = $ethnicStereotypes;
    }

    /**
     * @return array
     */
    public function getExoticism(): array
    {
        return $this->exoticism;
    }

    /**
     * @param array $exoticism
     */
    public function setExoticism(array $exoticism): void
    {
        $this->exoticism = $exoticism;
    }

}