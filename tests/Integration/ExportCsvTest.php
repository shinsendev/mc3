<?php

namespace App\Tests\Integration;

use App\Component\Exporter\Export;
use App\Tests\Functional\AbstractFunctionalTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ExportCsvTest extends AbstractFunctionalTest
{
    public function testExportCsv()
    {
        // prepare test configuration
        $container = static::getContainer();
        $kernel = $container->get(KernelInterface::class);
        $filesystem = $container->get(Filesystem::class);
        $em = $container->get(EntityManagerInterface::class);
        $projectDir = $kernel->getProjectDir(). '/tests/';
        $createdAt = new \DateTime();
        $serializer = $container->get(SerializerInterface::class);
        $container->get(Filesystem::class);

        //todo: create a specific command for upload file on S3?
//        $export = new Export($filesystem, $em, $projectDir, $createdAt, $serializer);
//        $export->execute();
    }
}