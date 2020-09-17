<?php

namespace App\Component\DTO\Export\CSV;

/**
 * Trait SongCsvExportDTO
 * @package App\Component\DTO\Export\Composition
 */
trait SongCsvExportDTO
{
    protected ?string $songs = null;
    //    private ?string $songTitle;
    //    private ?array $songLyricists;
    //    private ?array $songComposers;
    //    private ?string $songType;

    /**
     * @return string|null
     */
    public function getSongs(): ?string
    {
        return $this->songs;
    }

    /**
     * @param string|null $songs
     */
    public function setSongs(?string $songs): void
    {
        $this->songs = $songs;
    }

}