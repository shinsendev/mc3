<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AttributeRepository")
 */
class Attribute extends AbstractRelation
{
    /**
     * @ORM\Column(type="integer")
     */
    private $thesaurusId;

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
