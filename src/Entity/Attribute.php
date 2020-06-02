<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;
use App\Component\DTO\Payload\AttributePayloadDTO;

/**
 * @ApiResource(
 *     output=AttributePayloadDTO::class
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
    private $contributors = [];

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
}
