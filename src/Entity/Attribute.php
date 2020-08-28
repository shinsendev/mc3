<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;
use App\Component\DTO\Payload\AttributePayloadDTO;
use Doctrine\ORM\PersistentCollection;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 *     output=AttributePayloadDTO::class,
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="attributes")
     */
    private $category;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $example;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contributors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Film", mappedBy="attributes")
     * @ApiSubresource
     */
    private PersistentCollection $films;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Song", mappedBy="attributes")
     * @ApiSubresource
     */
    private PersistentCollection $songs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Number", mappedBy="attributes")
     * @ApiSubresource
     */
    private PersistentCollection $numbers;

    /**
     * @ORM\ManyToOne(targetEntity=Statistic::class)
     */
    private $stats;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getExample(): ?string
    {
        return $this->example;
    }

    public function setExample(?string $example): self
    {
        $this->example = $example;

        return $this;
    }

    public function getContributors(): ?array
    {
        return $this->contributors;
    }

    public function setContributors(?array $contributors): self
    {
        $this->contributors = $contributors;

        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getFilms(): PersistentCollection
    {
        return $this->films;
    }

    /**
     * @param PersistentCollection $films
     */
    public function setFilms(PersistentCollection $films): void
    {
        $this->films = $films;
    }

    /**
     * @return PersistentCollection
     */
    public function getSongs(): PersistentCollection
    {
        return $this->songs;
    }

    /**
     * @param PersistentCollection $songs
     */
    public function setSongs(PersistentCollection $songs): void
    {
        $this->songs = $songs;
    }

    /**
     * @return PersistentCollection
     */
    public function getNumbers(): PersistentCollection
    {
        return $this->numbers;
    }

    /**
     * @param PersistentCollection $numbers
     */
    public function setNumbers(PersistentCollection $numbers): void
    {
        $this->numbers = $numbers;
    }

    public function getStats(): ?Statistic
    {
        return $this->stats;
    }

    public function setStats(?Statistic $stats): self
    {
        $this->stats = $stats;

        return $this;
    }

}
