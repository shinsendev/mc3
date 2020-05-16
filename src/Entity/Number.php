<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NumberRepository")
 */
class Number extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\film", inversedBy="numbers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $beginTc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $endTc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $shots;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $references;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute")
     */
    private $attributes;

    public function __construct()
    {
        parent::__construct();
        $this->attributes = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getFilm(): ?film
    {
        return $this->film;
    }

    public function setFilm(?film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getBeginTc(): ?int
    {
        return $this->beginTc;
    }

    public function setBeginTc(?int $beginTc): self
    {
        $this->beginTc = $beginTc;

        return $this;
    }

    public function getEndTc(): ?int
    {
        return $this->endTc;
    }

    public function setEndTc(?int $endTc): self
    {
        $this->endTc = $endTc;

        return $this;
    }

    public function getShots(): ?int
    {
        return $this->shots;
    }

    public function setShots(?int $shots): self
    {
        $this->shots = $shots;

        return $this;
    }

    public function getReferences(): ?string
    {
        return $this->references;
    }

    public function setReferences(?string $references): self
    {
        $this->references = $references;

        return $this;
    }

    /**
     * @return Collection|Attribute[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribute $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
        }

        return $this;
    }
}
