<?php


namespace App\Component\Exporter;

use App\Component\Error\Mc3Error;
use App\Component\Exporter\Strategy\AbstractExportStrategy;
use App\Component\Exporter\Strategy\CsvExportStrategy;
use App\Component\Exporter\Strategy\JsonExportStrategy;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class Export implements ExportInterface
{
    private Filesystem $filesystem;
    private string $projectDir;
    private string $format;
    private \DateTime $createdAt;
    private EntityManagerInterface $em;

    public function __construct(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format = 'csv')
    {
        $this->filesystem = $filesystem;
        $this->projectDir = $projectDir;
        $this->format = $format;
        $this->em = $em;
        $this->createdAt = $createdAt;
    }

    public function execute():void
    {
        $this->getStrategy()->export($this->filesystem, $this->em, $this->projectDir, $this->createdAt, $this->format);
    }

    private function getStrategy():AbstractExportStrategy
    {
        if ($this->format === 'csv') {
            $strategy = new CsvExportStrategy();
        }
        else if ($this->format === 'json') {
            $strategy = new JsonExportStrategy();
        }
        else {
            return new Mc3Error('No valid format for this export.');
        }

        return $strategy;
    }

}