<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Component\DTO\Payload\PersonPayloadDTO;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     output=PersonPayloadDTO::class,
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     graphql={
 *      "item_query",
 *      "collection_query"
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person extends AbstractTarget
{
    const GENDER_MALE='M';
    const GENDER_FEMALE='F';
    const FIGURANT_PROFESSION='figurant';
    const DIRECTOR_PROFESSION='director';
    const CHOREGRAPH_PROFESSION='choregraph';
    const ARRANGER_PROFESSION='arranger';
    const PERFORMER_PROFESSION='performer';

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groupname;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $viaf;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contributors = [];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Work", mappedBy="person", orphanRemoval=true)
     */
    private $works;

    /**
     * @ORM\ManyToOne(targetEntity=Statistic::class)
     */
    private $stats;

    public function __construct()
    {
        parent::__construct();
        $this->works = new ArrayCollection();
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getGroupname(): ?string
    {
        return $this->groupname;
    }

    public function setGroupname(string $groupname): self
    {
        $this->groupname = $groupname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getViaf(): ?string
    {
        return $this->viaf;
    }

    public function setViaf(?string $viaf): self
    {
        $this->viaf = $viaf;

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
     * @return Collection|Work[]
     */
    public function getWorks(): Collection
    {
        return $this->works;
    }

    public function addWork(Work $work): self
    {
        if (!$this->works->contains($work)) {
            $this->works[] = $work;
            $work->setPerson($this);
        }

        return $this;
    }

    public function removeWork(Work $work): self
    {
        if ($this->works->contains($work)) {
            $this->works->removeElement($work);
            // set the owning side to null (unless already changed)
            if ($work->getPerson() === $this) {
                $work->setPerson(null);
            }
        }

        return $this;
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
