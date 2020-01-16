<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmRepository")
 */
class Film extends AbstractTarget
{
    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $productionYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $releasedYear;

    /**
     * @ORM\Column(name="imdb", type="string", nullable=true)
     */
    private $imdb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Number", mappedBy="film", orphanRemoval=true)
     */
    private $numbers;

    /**
     * @ORM\Column(name="length", type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(name="negative", type="integer", nullable=true)
     */
    private $negative;

    /**
     * @ORM\Column(name="remake", type="boolean", nullable=true)
     */
    private $remake;

    public function __construct()
    {
        $this->numbers = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    public function setProductionYear(?int $productionYear): self
    {
        $this->productionYear = $productionYear;

        return $this;
    }

    public function getReleasedYear(): ?int
    {
        return $this->releasedYear;
    }

    public function setReleasedYear(?int $releasedYear): self
    {
        $this->releasedYear = $releasedYear;

        return $this;
    }

    /**
     * @return Collection|Number[]
     */
    public function getNumbers(): Collection
    {
        return $this->numbers;
    }

    public function addNumber(Number $number): self
    {
        if (!$this->numbers->contains($number)) {
            $this->numbers[] = $number;
            $number->setFilm($this);
        }

        return $this;
    }

    public function removeNumber(Number $number): self
    {
        if ($this->numbers->contains($number)) {
            $this->numbers->removeElement($number);
            // set the owning side to null (unless already changed)
            if ($number->getFilm() === $this) {
                $number->setFilm(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImdb()
    {
        return $this->imdb;
    }

    /**
     * @param mixed $imdb
     */
    public function setImdb($imdb): void
    {
        $this->imdb = $imdb;
    }

    /**
     * @return mixed
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @return mixed
     */
    public function getNegative()
    {
        return $this->negative;
    }

    /**
     * @param mixed $negative
     */
    public function setNegative($negative): void
    {
        $this->negative = $negative;
    }

    /**
     * @return mixed
     */
    public function getRemake()
    {
        return $this->remake;
    }

    /**
     * @param mixed $remake
     */
    public function setRemake($remake): void
    {
        $this->remake = $remake;
    }
}
