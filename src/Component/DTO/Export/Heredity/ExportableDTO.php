<?php

namespace App\Component\DTO\Export\Heredity;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Export\Nested\ExportableFilmNestedDTO;
use App\Component\DTO\Export\Nested\ExportableSongNestedDTO;
use App\Component\DTO\Hierarchy\AbstractNumberDTO;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class ExportableDTO extends AbstractNumberDTO implements DTOInterface
{
    /**
     * @Groups({"export"})
     */
    private ?int $length = null;

    // films
    /**
     * @Groups({"export"})
     */
    private ?ExportableFilmNestedDTO $filmObject = null;

    // song
    /**
     * @Groups({"export"})
     * @var ExportableSongNestedDTO[]
     */
    private array $songsObject = [];

    // number
    /**
     * @Groups({"export"})
     */
    private ?string $releasedYearInDate = null;

    /**
     * @return ExportableFilmNestedDTO|null
     */
    public function getFilmObject(): ?ExportableFilmNestedDTO
    {
        return $this->filmObject;
    }

    /**
     * @param ExportableFilmNestedDTO|null $filmObject
     */
    public function setFilmObject(?ExportableFilmNestedDTO $filmObject): void
    {
        $this->filmObject = $filmObject;
    }

    /**
     * @return ExportableSongNestedDTO[]
     */
    public function getSongsObject(): array
    {
        return $this->songsObject;
    }

    /**
     * @param ExportableSongNestedDTO[] $songsObject
     */
    public function setSongsObject(array $songsObject): void
    {
        $this->songsObject = $songsObject;
    }

    /**
     * @return string|null
     */
    public function getReleasedYearInDate(): ?string
    {
        return $this->releasedYearInDate;
    }

    /**
     * @param string|null $releasedYearInDate
     */
    public function setReleasedYearInDate(?string $releasedYearInDate): void
    {
        $this->releasedYearInDate = $releasedYearInDate;
    }

    /**
     * @return int|null
     */
    public function getLength(): ?int
    {
        return $this->length;
    }

    /**
     * @param int|null $length
     */
    public function setLength(?int $length): void
    {
        $this->length = $length;
    }
}
