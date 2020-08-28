<?php


namespace App\Component\DTO\Stats\Attribute;


use App\Component\DTO\Definition\DTOInterface;

class AttributeStatsDTO implements DTOInterface
{
    private array $countByYears = [];

    /**
     * @return array
     */
    public function getCountByYears(): array
    {
        return $this->countByYears;
    }

    /**
     * @param array $countByYears
     */
    public function setCountByYears(array $countByYears): void
    {
        $this->countByYears = $countByYears;
    }

}