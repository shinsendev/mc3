<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractRelation;
use Doctrine\ORM\Mapping as ORM;

// le thesausurus = le moins normé, ce que le projet a inventé, nos descripteurs
/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute extends AbstractRelation
{
    /**
     * @ORM\Column(type="integer")
     */
    private $thesaurusId;

    // le type du thesaurus comme number, film, etc.
    private $type;

    /**
     * @return mixed
     */
    public function getThesaurusId()
    {
        return $this->thesaurusId;
    }

    /**
     * @param mixed $thesaurusId
     */
    public function setThesaurusId($thesaurusId): void
    {
        $this->thesaurusId = $thesaurusId;
    }
}
