<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $imdb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Number", mappedBy="film", orphanRemoval=true)
     */
    private $numbers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $length;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $remake;

    /**
     * @ORM\Column(type="boolean", nullable=true)
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
     * todo: validate with Marguerite
     * Description: New field for stageshow reference - to be confirmed
     * @ORM\Column(type="string", nullable=true)
     */
    private $viaf;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Attribute")
     */
    private $attributes;

//    //thesaurus many to one // censorship
//    private $adaptation;
//
//    // thesaurus many to one // censorship
//    private $verdict;
//
//    // thesaurus many to one // censorship
//    private $legion;
//
//    // thesaurus many to one // censorship
//    private $protestant;
//
//    // thesaurus many to one // censorship
//    private $harrison;
//
//    // thesaurus many to one
//    private $board;
//
//    // many to one thesaurus, old censorship table
//    private $censorship;

//    /**
//     * @ORM\Column(name="comments", type="text", nullable=true)
//     */
//    private $comments;


    public function __construct()
    {
        parent::__construct();
        $this->numbers = new ArrayCollection();
        $this->attributes = new ArrayCollection();
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
}
