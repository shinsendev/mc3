<?php


namespace App\Component\DTO\Nested\Elastic;


use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Component\DTO\Nested\PersonNestedDTO;

class ElasticFilmNestedDTO extends AbstractUniqueDTO
{
    private ?int $releasedYear = null;
    private ?string $sample = null;
    private ?string $adaptation = null;
    private array $filmCensorships = [];
    private array $legion = [];
    private array $pca = [];
    private array $states = [];
    private array $studios = [];
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
    public function getFilmCensorships(): array
    {
        return $this->filmCensorships;
    }

    /**
     * @param array $filmCensorships
     */
    public function setFilmCensorships(array $filmCensorships): void
    {
        $this->filmCensorships = $filmCensorships;
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

}