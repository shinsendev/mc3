<?php


namespace App\Component\Exporter;

use Symfony\Component\Filesystem\Filesystem;

class Export implements ExportInterface
{
    public static function init(Filesystem $filesystem, string $rootDir)
    {
        $filesystem->mkdir($rootDir.'/data');
        $name = (new \DateTime())->format('Y-m-d_His') . '_mc2-export';
        $dataDir = $rootDir.'/data/'.$name.'/';
        $filesystem->mkdir($dataDir);

        // create the empty files in the same folder
        $filesystem->touch($dataDir.$name.'.csv');
        $filesystem->touch($dataDir.$name.'.json');
    }


}