<?php


namespace App\Component\Exporter;

use App\Component\Error\Mc3Error;
use Symfony\Component\Filesystem\Filesystem;

class Export implements ExportInterface
{
    private Filesystem $filesystem;
    private string $rootDir;
    private string $format;

    public function __construct(Filesystem $filesystem, string $rootDir, string $format = 'csv')
    {
        $this->filesystem = $filesystem;
        $this->rootDir = $rootDir;
        $this->format = $format;
    }

    public function execute()
    {
        if ($this->format === 'csv') {
            // do a CSVExport
        }
        else if ($this->format === 'json'){
            // do a JsonExport
        }
        else {
            return new Mc3Error('No valid format for this export.');
        }
    }

//    public static function init(Filesystem $filesystem, string $rootDir, string $format = 'csv')
//    {
//        $filesystem->mkdir($rootDir.'/data');
//        $name = (new \DateTime())->format('Y-m-d_His') . '_mc2-export';
//        $dataDir = $rootDir.'/data/'.$name.'/';
//        $filesystem->mkdir($dataDir);
//
//        // create the empty files in the same folder
//        $filesystem->touch($dataDir.$name.'.csv');
//        $filesystem->touch($dataDir.$name.'.json');
//    }


}