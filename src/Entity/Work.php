<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractRelation;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 *
 * //todo : create an Abstract Relation Type with target and relation type?
 */
class Work extends AbstractRelation
{
    // the primary key could be a composite key with personId an professionId or at least we must have an unicity key for that

    /**
     * @ORM\Column(type="integer")
     */
    private $personId;

    /**
     * todo : replace by relationType?
     *
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @return mixed
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * @param mixed $personId
     */
    public function setPersonId($personId): void
    {
        $this->personId = $personId;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @param mixed $profession
     */
    public function setProfession($profession): void
    {
        $this->profession = $profession;
    }
}
