<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractExportStrategy implements ExportStrategyInterface
{
    const SUCCESS_RESPONSE = "Export is finished with success.\n";

    function getParams(\DateTime $createdAt, string $projectDir, string $format)
    {
        $createdAtFile = $createdAt->format('Y-m-d_His');
        $createdAtFolder = $createdAt->format('Y-m-d');
        $filename = $createdAtFile . '_export.'.$format;
        $dataDir =  $projectDir . '/data/';

        return [
            'createdAtFolder' => $createdAtFolder,
            'filename' => $filename,
            'dataDir' => $dataDir,
            'completeFilename' =>  $dataDir.$createdAtFolder.'/'.$filename
        ];
    }

    function createFile(Filesystem $filesystem, string $dataDir, string $datetime, string $filename):void
    {
        $filesystem->mkdir($dataDir);
        $filesystem->mkdir($dataDir.$datetime.'/');
        $filesystem->touch($dataDir.$datetime.'/'.$filename);
    }
}