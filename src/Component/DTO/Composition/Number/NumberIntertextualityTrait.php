<?php

declare(strict_types=1);

namespace App\Component\DTO\Composition\Number;

use App\Component\DTO\Payload\NumberPayloadDTO;

trait NumberIntertextualityTrait
{
    /** @var array */
    private $sources = []; // AttributeNestedDTO

    /** @var array */
    private $quotation = []; // AttributeNestedDTO

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