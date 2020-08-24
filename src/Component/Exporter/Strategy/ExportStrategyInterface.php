<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Symfony\Component\Filesystem\Filesystem;

interface ExportStrategyInterface
{
    function import(Filesystem $filesystem, string $path);
    function init(Filesystem $filesystem, string $rootDir, string $format = 'csv');
}