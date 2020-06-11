<?php

declare(strict_types=1);

namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;

trait NumberIntertextualityTrait
{
    /** @var array */
    private $source = NumberPayloadDTO::NO_VALUE; // AttributeNestedDTO

    /** @var array */
    private $quotation = []; // AttributeNestedDTO

    /**
     * @return array
     */
    public function getSource(): array
    {
        return $this->source;
    }

    /**
     * @param array $source
     */
    public function setSource(array $source): void
    {
        $this->source = $source;
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