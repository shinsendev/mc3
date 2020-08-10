<?php


namespace App\Component\DTO\Import;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Hierarchy\AbstractUniqueDTO;
use phpDocumentor\Reflection\Types\Boolean;

class AbstractImportDTO extends AbstractUniqueDTO implements DTOInterface
{
    const READY_STATUS = 'ready';
    const COMPLETED_STATUS = 'completed';
    const FAILED_STATUS = 'failed';

    private string $status = self::READY_STATUS;
    private Boolean $inProgress;

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