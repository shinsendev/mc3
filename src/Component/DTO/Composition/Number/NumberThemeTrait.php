<?php

declare(strict_types=1);


namespace App\Component\DTO\Composition\Number;

use Symfony\Component\Serializer\Annotation\Groups;

trait NumberThemeTrait
{
    /**
     * @Groups({"export"})
     */
    protected array $topic = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $diegeticPlace = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $imaginaryPlace = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $ethnicStereotypes = []; // AttributeNestedDTO

    /**
     * @Groups({"export"})
     */
    protected array $exoticism = []; // AttributeNestedDTO

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
