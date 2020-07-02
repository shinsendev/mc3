<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use App\Repository\StatisticRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $key;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $label;

    /**
     * @ORM\Column(type="json")
     */
    private array $value = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $model;

    /**
     * @ORM\Column(type="guid", nullable=true)
     */
    private string $target_uuid;

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getValue(): ?array
    {
        return $this->value;
    }

    public function setValue(array $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getTargetUuid(): ?string
    {
        return $this->target_uuid;
    }

    public function setTargetUuid(?string $target_uuid): self
    {
        $this->target_uuid = $target_uuid;

        return $this;
    }
}
