<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Component\DTO\Payload\FilmPayloadDTO;

/**
 * @ApiResource(
 *     output=FilmPayloadDTO::class
 * )
 *
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $imdb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Number", mappedBy="film", orphanRemoval=true)
     * @ORM\OrderBy({"beginTc" = "ASC"})
     */
    private $numbers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $remake;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $sample;

    /**
     * Description: in fact it is more a comment, only 4 texts (ex = Jewish comic, PCA afraid of the nude drawings and statues in the setting)
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $pca;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $stageshows;

    /**
     * Description: New field for stageshow reference - to be confirmed
     * @ORM\Column(type="string", nullable=true)
     */
    private $viaf;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute")
     */
    private $attributes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Comment")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Studio", inversedBy="films")
     */
    private $studios;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Distributor", inversedBy="films")
     */
    private $Distributor;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contributors = [];

    /**
     * Film constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();
        $this->numbers = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->studios = new ArrayCollection();
        $this->Distributor = new ArrayCollection();
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
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
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

    /**
     * @return mixed
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * @param mixed $sample
     */
    public function setSample($sample): void
    {
        $this->sample = $sample;
    }

    /**
     * @return mixed
     */
    public function getPca()
    {
        return $this->pca;
    }

    /**
     * @param mixed $pca
     */
    public function setPca($pca): void
    {
        $this->pca = $pca;
    }

    /**
     * @return mixed
     */
    public function getStageshows()
    {
        return $this->stageshows;
    }

    /**
     * @param mixed $stageshows
     */
    public function setStageshows($stageshows): void
    {
        $this->stageshows = $stageshows;
    }

    /**
     * @return mixed
     */
    public function getViaf()
    {
        return $this->viaf;
    }

    /**
     * @param mixed $viaf
     */
    public function setViaf($viaf): void
    {
        $this->viaf = $viaf;
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

    /**
     * @return Collection|Studio[]
     */
    public function getStudios(): Collection
    {
        return $this->studios;
    }

    public function addStudio(Studio $studio): self
    {
        if (!$this->studios->contains($studio)) {
            $this->studios[] = $studio;
        }

        return $this;
    }

    public function removeStudio(Studio $studio): self
    {
        if ($this->studios->contains($studio)) {
            $this->studios->removeElement($studio);
        }

        return $this;
    }

    /**
     * @return Collection|Distributor[]
     */
    public function getDistributor(): Collection
    {
        return $this->Distributor;
    }

    public function addDistributor(Distributor $distributor): self
    {
        if (!$this->Distributor->contains($distributor)) {
            $this->Distributor[] = $distributor;
        }

        return $this;
    }

    public function removeDistributor(Distributor $distributor): self
    {
        if ($this->Distributor->contains($distributor)) {
            $this->Distributor->removeElement($distributor);
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

}
