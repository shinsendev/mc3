<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractExportStrategy implements ExportStrategyInterface
{
    public function init(Filesystem $filesystem, string $rootDir, string $format = 'csv')
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