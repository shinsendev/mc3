<?php

declare(strict_types=1);

namespace App\Component\DTO\Payload;

use App\Component\DTO\Composition\UniqueDTOTrait;

class HomePayloadDTO
{
    use UniqueDTOTrait;

    private $stats;

    /**
     * @var array
     */
    private $thematics;

    /**
     * @var array
     */
    private $films;

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     */
    public function setStats($stats): void
    {
        $this->stats = $stats;
    }

    /**
     * @return array
     */
    public function getThematics(): array
    {
        return $this->thematics;
    }

    /**
     * @param array $thematics
     */
    public function setThematics(array $thematics): void
    {
        $this->thematics = $thematics;
    }

    /**
     * @return array
     */
    public function getFilms(): array
    {
        return $this->films;
    }

    /**
     * @param array $films
     */
    public function setFilms(array $films): void
    {
        $this->films = $films;
    }
}