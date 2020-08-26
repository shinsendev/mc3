<?php

declare(strict_types=1);

namespace App\Component\Exporter\Strategy;

use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\NumberPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class JsonExportStrategy
 * @package App\Component\Exporter\Strategy
 */
class JsonExportStrategy extends AbstractExportStrategy
{
    function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format):string
    {
        $params = $this->getParams($createdAt, $projectDir, $format);

        // create folder and file
        $this->createFile($filesystem, $params['dataDir'], $params['createdAtFolder'], $params['filename']);

        // get data and prepare normalizer
        $numbers = $em->getRepository(Number::class)->findAll();

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $filesystem->appendToFile($params['completeFilename'], '[');

        // by numbers, for all items
        $i = 0;
        $length = count($numbers);
        foreach ($numbers as $number) {
            $exportDTO = DTOFactory::create(ModelConstants::NUMBER_PAYLOAD_MODEL);
            $exportDTO = NumberPayloadHydrator::hydrate($exportDTO, ['number' => $number], $em);
            $exportDTO = $serializer->serialize($exportDTO, 'json');

            if ($i === $length - 1) {
                $filesystem->appendToFile($params['completeFilename'], $exportDTO);
            }
            else {
                $filesystem->appendToFile($params['completeFilename'], $exportDTO. ',');
            }
            $i++;
        }

        $filesystem->appendToFile($params['completeFilename'], ']');

        return parent::SUCCESS_RESPONSE;
    }

}