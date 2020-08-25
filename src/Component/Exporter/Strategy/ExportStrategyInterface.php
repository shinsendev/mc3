<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

interface ExportStrategyInterface
{
    function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format):string;
    function createFile(Filesystem $filesystem, string $dataDir, string $createdAt, string $filename);
}