<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Component\DTO\Payload\CategoryPayloadDTO;

/**
 * @ApiResource(
 *     output=CategoryPayloadDTO::class,
 *     attributes={"pagination_items_per_page"=100},
 *     collectionOperations={"get"},
 *     itemOperations={"get"},
 *     graphql={
 *      "item_query",
 *      "collection_query"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category extends AbstractTarget
{
    CONST PERFORMANCE_TYPE = 'performance_thesaurus';
    CONST STRUCTURE_TYPE = 'structure';
    CONST COMPLETENESS_TYPE = 'completeness_thesaurus';
    CONST SOURCE_TYPE = 'source_thesaurus';
    CONST DIEGETIC_TYPE = 'diegetic_thesaurus';
    const CENSORSHIP_CODE = 'censorship';
    const PCA_CODE= 'verdict';
    const STATES_CODE = 'state';
    const ADAPTATION_CODE = 'adaptation';
    const BEGIN_CODE = 'begin_thesaurus';
    const ENDING_CODE = 'ending_thesaurus';
    const LEGION_CODE = 'legion';
    const HARRISSON_CODE = 'harrison';
    const BOARD_CODE = 'board';

    /**
     * @ORM\Column(type="string", length=510)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Attribute", mappedBy="category")
     */
    private $attributes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $model;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contributors = [];

    public function __construct()
    {
        parent::__construct();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
            $attribute->setCategory($this);
        }

        return $this;
    }

    public function removeAttribute(Attribute $attribute): self
    {
        if ($this->attributes->contains($attribute)) {
            $this->attributes->removeElement($attribute);
            // set the owning side to null (unless already changed)
            if ($attribute->getCategory() === $this) {
                $attribute->setCategory(null);
            }
        }

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): self
    {
        $this->model = $model;

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
