<?php

declare(strict_types=1);

namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;

trait NumberIntertextualityTrait
{
    /** @var string */
    private $source = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var array */
    private $quotation = [];

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source): void
    {
        $this->source = $source;
    } // AttributeNestedDTO


    /**
     * @return array
     */
    public function getQuotation(): array
    {
        return $this->quotation;
    }

    /**
     * @param array $quotation
     */
    public function setQuotation(array $quotation): void
    {
        $this->quotation = $quotation;
    }

}