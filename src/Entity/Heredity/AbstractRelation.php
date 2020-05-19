<?php

namespace App\Entity\Heredity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractRelation
 * @package App\Entity
 *
 * todo : remove id, must be supperclass at the end
 */
abstract class AbstractRelation extends AbstractEntity
{
    /**
     * @ORM\Column(type="integer")
     */
    private $targetUuid;

    /**
     * @ORM\Column(type="string")
     */
    private $targetType;

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
}