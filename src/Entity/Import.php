<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Import\ImportInputDTO;
use App\Component\DTO\Import\ImportOutputDTO;
use App\Entity\Heredity\AbstractTarget;
use App\Repository\ImportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     input=ImportInputDTO::class,
 *     output=ImportOutputDTO::class,
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"}
 * )
 * @ORM\Entity(repositoryClass=ImportRepository::class)
 */
class Import extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $inProgress;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInProgress(): ?bool
    {
        return $this->inProgress;
    }

    public function setInProgress(bool $inProgress): self
    {
        $this->inProgress = $inProgress;

        return $this;
    }
}