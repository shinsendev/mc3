<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Component\DTO\Payload\NumberPayloadDTO;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ApiResource(
 *     output=NumberPayloadDTO::class,
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 * @ApiFilter(OrderFilter::class, properties={"film.releasedYear":"ASC", "title":"ASC"}, arguments={"orderParameterName"="order"})
 *
 * @ORM\Entity(repositoryClass="App\Repository\NumberRepository")
 */
class Number extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="numbers")
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute", inversedBy="numbers")
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Comment")
     */
    private $comments;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contributors = [];

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Song", inversedBy="numbers")
     */
    private $songs;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $dubbing;

    public function __construct()
    {
        parent::__construct();
        $this->attributes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->songs = new ArrayCollection();
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

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }

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
     * @return Collection|Song[]
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs[] = $song;
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->songs->contains($song)) {
            $this->songs->removeElement($song);
        }

        return $this;
    }

    public function getDubbing(): ?string
    {
        return $this->dubbing;
    }

    public function setDubbing(?string $dubbing): self
    {
        $this->dubbing = $dubbing;

        return $this;
    }

}
