<?php


namespace App\Entity\Heredity;

use Doctrine\ORM\Mapping as ORM;

abstract class AbstractImportable extends AbstractTarget
{
    const READY_STATUS = 'ready'; // by default
    const STARTED_STATUS = "started"; // set just before sending the POST to the importer and until there is e reponse
    const FAILED_STATUS = 'failed';
    const SUCCESS_STATUS = 'success';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $inProgress;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInProgress(): ?bool
    {
        return $this->inProgress;
    }

    public function setInProgress(bool $inProgress): self
    {
        $this->inProgress = $inProgress;

        return $this;
    }
}