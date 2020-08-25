<?php

declare(strict_types=1);

namespace App\Component\Exporter\Strategy;

use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;

class CsvExportStrategy extends AbstractExportStrategy
{
    public function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format)
    {
        $createdAt = $createdAt->format('Y-m-d_His');
        $filename = $createdAt . '_export.'.$format;
        $dataDir =  $projectDir . '/data/';
        $completeFilename = $dataDir.$createdAt.'/'.$filename;

        // create folder and file
        $this->createFile($filesystem, $dataDir, $createdAt, $filename);

        // todo: add data
        $numbers = $em->getRepository(Number::class)->findAll();
        foreach ($numbers as $number) {
            $filesystem->appendToFile($completeFilename,$number->getTitle());
        }
        $filesystem->appendToFile($completeFilename, 'Email sent to user@example.com');
        // by numbers
        // foreach numbers

        // todo: return result
    }

    private function write()
    {

    }

}