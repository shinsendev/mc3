<?php

declare(strict_types=1);

namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;

/**
 * Trait NumberIntertextualityTrait
 * @package App\Component\DTO\Composition\Number
 */
trait NumberIntertextualityTrait
{
    private array $sources = []; // AttributeNestedDTO
    private array $quotation = []; // AttributeNestedDTO

    /**
     * @return array
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param array $sources
     */
    public function setSources(array $sources): void
    {
        $this->sources = $sources;
    }

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