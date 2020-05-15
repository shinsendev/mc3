<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 */
class Song extends AbstractTarget
{
    /**
     * @ORM\Column(type="string", length=510)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $lyrics;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getLyrics(): ?string
    {
        return $this->lyrics;
    }

    public function setLyrics(?string $lyrics): self
    {
        $this->lyrics = $lyrics;

        return $this;
    }
}
