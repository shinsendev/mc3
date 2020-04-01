<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractTarget;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person extends AbstractTarget
{
    private $groupname;

    private $firstname;

    private $lastname;

    private $gender;

    private $imdb;
}
