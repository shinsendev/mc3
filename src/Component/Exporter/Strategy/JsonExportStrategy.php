<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class JsonExportStrategy extends AbstractExportStrategy
{
    function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format):string
    {
//        $createdAt = $createdAt->format('Y-m-d_His');
//        $filename = $createdAt . '_export.'.$format;
//        $dataDir =  $projectDir . '/data/';
//        $completeFilename = $dataDir.$createdAt.'/'.$filename;
//
//        // create folder and file
//        $this->createFile($filesystem, $dataDir, $createdAt, $filename);

        // TODO: Implement import() method.
        return parent::SUCCESS_RESPONSE;
    }

}