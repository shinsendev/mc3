<?php


namespace App\Component\Exporter;

use App\Component\Error\Mc3Error;
use App\Component\Exporter\Strategy\CsvExportStrategy;
use App\Component\Exporter\Strategy\ExportStrategyInterface;
use App\Component\Exporter\Strategy\JsonExportStrategy;
use Symfony\Component\Filesystem\Filesystem;

class Export implements ExportInterface
{
    private Filesystem $filesystem;
    private string $rootDir;
    private string $format;
    private ExportStrategyInterface $strategy;

    public function __construct(Filesystem $filesystem, string $rootDir, string $format = 'csv')
    {
        $this->filesystem = $filesystem;
        $this->rootDir = $rootDir;
        $this->format = $format;
    }

    public function execute():void
    {
        $this->strategy = $this->getStrategy();
        $this->strategy->import();
    }

    private function getStrategy():ExportStrategyInterface
    {
        if ($this->format === 'csv') {
            $strategy = new CsvExportStrategy($filesystem, $path);
            // do a CSVExport
        }
        else if ($this->format === 'json'){
            $strategy = new JsonExportStrategy($filesystem, $path);
            // do a JsonExport
        }
        else {
            return new Mc3Error('No valid format for this export.');
        }

        return $strategy;
    }

    public static function init(Filesystem $filesystem, string $rootDir, string $format = 'csv')
    {
        $filesystem->mkdir($rootDir.'/data');
        $name = (new \DateTime())->format('Y-m-d_His') . '_mc2-export';
        $dataDir = $rootDir.'/data/'.$name.'/';
        $filesystem->mkdir($dataDir);

//        // create the empty files in the same folder
//        $filesystem->touch($dataDir.$name.'.csv');
//        $filesystem->touch($dataDir.$name.'.json');
    }


}