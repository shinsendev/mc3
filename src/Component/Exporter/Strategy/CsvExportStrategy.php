<?php

declare(strict_types=1);

namespace App\Component\Exporter\Strategy;

use App\Component\DTO\Export\CSV\CsvExportDTO;
use App\Component\Error\Mc3Error;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\Export\ExportCsvHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CsvExportStrategy extends AbstractExportStrategy
{
    public function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format):string
    {
        // set vars
        $params = $this->getParams($createdAt, $projectDir, $format);

        // create folder and file
        $this->createFile($filesystem, $params['dataDir'], $params['createdAtFolder'], $params['filename']);

        // add header
        $filesystem->appendToFile($params['completeFilename'], $this->createHeader()."\n");

        // get data and prepare normalizer
        $numbers = $em->getRepository(Number::class)->findAll();
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers);

        // add all lines
        foreach ($numbers as $number) {
            // create a DTO for each line and convert it into an array
            $exportDTO = DTOFactory::create(ModelConstants::EXPORT_CSV_DTO);
            $exportDTO = ExportCsvHydrator::hydrate($exportDTO, ['number'  => $number], $em);
            $line = $serializer->normalize($exportDTO);
            $stringLine = implode(";", $line);
            $filesystem->appendToFile($params['completeFilename'], $stringLine."\n");
        }

        // upload the file to the S3 server
        parent::upload($params['completeFilename'], $format);

        return parent::SUCCESS_RESPONSE;
    }

    private function createHeader():string
    {
        // add header
        $reflect = new \ReflectionClass(CsvExportDTO::class);
        $properties = $reflect->getProperties(\ReflectionProperty::IS_PROTECTED);

        $header = null;
        foreach ($properties as $property) {
            if (!$header) {
                $header .= $property->getName();
            }
            else {
                $header .= ';'.$property->getName();
            }
        }

        if (!$header) {
            throw new Mc3Error('No data to export', 400);
        }

        return $header;

    }

}