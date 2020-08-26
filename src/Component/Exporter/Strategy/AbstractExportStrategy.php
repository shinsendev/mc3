<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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

    function upload(string $completeFilename, string $format):void
    {
        $process = Process::fromShellCommandline('aws s3 cp '.$completeFilename.' s3://mc3-website/data/last_export.'.$format);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}