<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SongRepository")
 */
class Song extends AbstractTarget
{
    private $title;

    private $type;

    private $released;

    private $lyricists;

    private $composers;
}
