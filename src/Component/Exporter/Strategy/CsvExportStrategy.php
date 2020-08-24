<?php

declare(strict_types=1);

namespace App\Component\Exporter\Strategy;

use Symfony\Component\Filesystem\Filesystem;

class CsvExportStrategy extends AbstractExportStrategy
{
    function import(Filesystem $filesystem, string $path)
    {
        $this->init($filesystem, $path);
        // todo: add data

        // todo: return result
    }

}