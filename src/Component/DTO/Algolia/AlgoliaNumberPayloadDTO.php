<?php


namespace App\Component\DTO\Algolia;


use App\Component\DTO\Hierarchy\AbstractNumberDTO;

/**
 * Class AlgoliaNumberPayloadDTO
 * @package App\Component\DTO\Algolia
 */
class AlgoliaNumberPayloadDTO extends AbstractNumberDTO
{
    private int $length = 0;

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }


}
