<?php


namespace App\Component\Exporter;

use App\Component\Error\Mc3Error;
use App\Component\Exporter\Strategy\CsvExportStrategy;
use App\Component\Exporter\Strategy\ExportStrategyInterface;
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
        $this->createdAt = $createdAt;
        $this->em = $em;
    }

    public function execute():void
    {
        ($this->getStrategy())->export($this->filesystem, $this->em,$this->projectDir, $this->createdAt, $this->format);
    }

    private function getStrategy():ExportStrategyInterface
    {
        if ($this->format === 'csv') {
            $strategy = new CsvExportStrategy();
            // do a CSVExport
        }
        else if ($this->format === 'json'){
            $strategy = new JsonExportStrategy();
            // do a JsonExport
        }
        else {
            throw new Mc3Error('No valid format for this export.', 400);
        }

        return $strategy;
    }

}