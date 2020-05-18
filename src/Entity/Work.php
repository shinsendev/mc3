<?php

namespace App\Entity;

use App\Entity\Heredity\AbstractRelation;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description : a relation between a person and an entity, ex: performer, director
 * Has a composite primary key
 *
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 */
class Work
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     */
    private $personId;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @ORM\Id()
     */
    private $targetUuid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * AbstractTarget constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

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

    /**
     * @return mixed
     */
    public function getTargetUuid()
    {
        return $this->targetUuid;
    }

    /**
     * @param mixed $targetUuid
     */
    public function setTargetUuid($targetUuid): void
    {
        $this->targetUuid = $targetUuid;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
