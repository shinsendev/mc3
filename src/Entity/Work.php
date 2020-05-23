<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description : a relation between a person and an entity, ex: performer, director
 * Has a composite primary key
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="work_idx", columns={"person_id", "target_uuid", "target_type", "profession"})})
 *
 * @ORM\Entity(repositoryClass="App\Repository\WorkRepository")
 */
class Work
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $targetUuid;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $targetType;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $profession;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="works")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * AbstractTarget constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    public function getId(): int
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getTargetType()
    {
        return $this->targetType;
    }

    /**
     * @param mixed $targetType
     */
    public function setTargetType($targetType): void
    {
        $this->targetType = $targetType;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

}
