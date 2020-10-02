<?php


namespace App\Component\DTO\Export\Nested;


use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\PersonNestedDTO;
use Symfony\Component\Serializer\Annotation\Groups;

class ExportableFilmNestedDTO extends AbstractUniqueDTO
{
    /**
     * @Groups({"export"})
     */
    private ?int $releasedYear = null;

    /**
     * @Groups({"export"})
     */
    private ?string $sample = null;

    /**
     * @Groups({"export"})
     */
    private ?string $adaptation = null;

    /**
     * @Groups({"export"})
     */
    private array $censorships = [];

    /**
     * @Groups({"export"})
     */
    private array $legion = [];

    /**
     * @Groups({"export"})
     */
    private array $pca = [];

    /**
     * @Groups({"export"})
     */
    private array $states = [];

    /**
     * @Groups({"export"})
     */
    private array $studios = [];

    /**
     * @Groups({"export"})
     */
    private ?int $length = null;

    /**
     * @Groups({"export"})
     */
    private array $board = [];

    /**
     * @Groups({"export"})
     */
    private array $harrison = [];

    /**
     * @var PersonNestedDTO[]
     */
    private array $directors = [];

    /**
     * @return int|null
     */
    public function getReleasedYear(): ?int
    {
        return $this->releasedYear;
    }

    /**
     * @param int|null $releasedYear
     */
    public function setReleasedYear(?int $releasedYear): void
    {
        $this->releasedYear = $releasedYear;
    }

    /**
     * @return string|null
     */
    public function getSample(): ?string
    {
        return $this->sample;
    }

    /**
     * @param string|null $sample
     */
    public function setSample(?string $sample): void
    {
        $this->sample = $sample;
    }

    /**
     * @return string|null
     */
    public function getAdaptation(): ?string
    {
        return $this->adaptation;
    }

    /**
     * @param string|null $adaptation
     */
    public function setAdaptation(?string $adaptation): void
    {
        $this->adaptation = $adaptation;
    }

    /**
     * @return array
     */
    public function getCensorships(): array
    {
        return $this->censorships;
    }

    /**
     * @param array $censorships
     */
    public function setCensorships(array $censorships): void
    {
        $this->censorships = $censorships;
    }

    /**
     * @return array
     */
    public function getLegion(): array
    {
        return $this->legion;
    }

    /**
     * @param array $legion
     */
    public function setLegion(array $legion): void
    {
        $this->legion = $legion;
    }

    /**
     * @return array
     */
    public function getPca(): array
    {
        return $this->pca;
    }

    /**
     * @param array $pca
     */
    public function setPca(array $pca): void
    {
        $this->pca = $pca;
    }

    /**
     * @return array
     */
    public function getStates(): array
    {
        return $this->states;
    }

    /**
     * @param array $states
     */
    public function setStates(array $states): void
    {
        $this->states = $states;
    }

    /**
     * @return array
     */
    public function getStudios(): array
    {
        return $this->studios;
    }

    /**
     * @param array $studios
     */
    public function setStudios(array $studios): void
    {
        $this->studios = $studios;
    }

    /**
     * @return PersonNestedDTO[]
     */
    public function getDirectors(): array
    {
        return $this->directors;
    }

    /**
     * @param PersonNestedDTO[] $directors
     */
    public function setDirectors(array $directors): void
    {
        $this->directors = $directors;
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

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * @param array $board
     */
    public function setBoard(array $board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getHarrison(): array
    {
        return $this->harrison;
    }

    /**
     * @param array $harrison
     */
    public function setHarrison(array $harrison): void
    {
        $this->harrison = $harrison;
    }

}
