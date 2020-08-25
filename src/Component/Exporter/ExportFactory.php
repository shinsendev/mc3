<?php

declare(strict_types=1);

namespace App\Component\Exporter;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class ExportFactory
{
    /**
     * @param Filesystem $filesystem
     * @param EntityManagerInterface $em
     * @param string $projectDir
     * @param string $format
     * @param \DateTime|null $createdAt
     * @return Export
     */
    public static function create(
        Filesystem $filesystem,
        EntityManagerInterface $em,
        string $projectDir,
        string $format,
        \DateTime $createdAt
    ):Export
    {
        return new Export($filesystem, $em, $projectDir, $createdAt, $format);
    }
}