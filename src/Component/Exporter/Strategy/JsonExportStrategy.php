<?php

declare(strict_types=1);


namespace App\Component\Exporter\Strategy;


use Symfony\Component\Filesystem\Filesystem;

class JsonExportStrategy extends AbstractExportStrategy
{
    function import(Filesystem $filesystem, string $path)
    {
        // TODO: Implement import() method.
    }

}