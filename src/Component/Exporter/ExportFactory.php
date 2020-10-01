<?php

declare(strict_types=1);

namespace App\Component\Exporter;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

class ExportFactory
{
    /**
     * @param Filesystem $filesystem
     * @param EntityManagerInterface $em
     * @param string $projectDir
     * @param string $format
     * @param \DateTime $createdAt
     * @param SerializerInterface $serializer
     * @return Export
     */
    public static function create(
        Filesystem $filesystem,
        EntityManagerInterface $em,
        string $projectDir,
        string $format,
        \DateTime $createdAt,
        SerializerInterface $serializer
    ):Export
    {
        return new Export($filesystem, $em, $projectDir, $createdAt, $serializer, $format);
    }
}
