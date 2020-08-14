<?php


namespace App\Component\DTO\Import;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use App\Entity\Heredity\AbstractImportable;

class AbstractImportableDTO extends AbstractUniqueDTO implements DTOInterface
{

    private string $status = AbstractImportable::READY_STATUS;
    private bool $inProgress = false;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isInProgress(): bool
    {
        return $this->inProgress;
    }

    /**
     * @param bool $inProgress
     */
    public function setInProgress(bool $inProgress): void
    {
        $this->inProgress = $inProgress;
    }

}