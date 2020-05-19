<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThesaurusRepository")
 */
class Thesaurus extends AbstractTarget
{
}
