<?php

declare(strict_types=1);

namespace App\Component\Exporter\Strategy;

use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\Export\ExportJsonHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Number;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class JsonExportStrategy
 * @package App\Component\Exporter\Strategy
 */
class JsonExportStrategy extends AbstractExportStrategy
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    function export(Filesystem $filesystem, EntityManagerInterface $em, string $projectDir, \DateTime $createdAt, string $format):string
    {
        $params = $this->getParams($createdAt, $projectDir, $format);

        // create folder and file
        $this->createFile($filesystem, $params['dataDir'], $params['createdAtFolder'], $params['filename']);

        // get data
        $numbers = $em->getRepository(Number::class)->findAll();

        // begin to create file with a json array
        $filesystem->appendToFile($params['completeFilename'], '[');

        // by numbers, for all items
        $i = 0;
        $length = count($numbers);
        foreach ($numbers as $number) {
            $exportDTO = DTOFactory::create(ModelConstants::EXPORT_JSON_DTO);
            $exportDTO = ExportJsonHydrator::hydrate($exportDTO, ['number' => $number], $em);
            // need to add numbers elements

            $exportDTO = $this->serializer->serialize($exportDTO, 'json', ['groups' => 'export']);

            if ($i === $length - 1) {
                $filesystem->appendToFile($params['completeFilename'], $exportDTO);
            }
            else {
                $filesystem->appendToFile($params['completeFilename'], $exportDTO. ',');
            }
            $i++;
        }

        $filesystem->appendToFile($params['completeFilename'], ']');

        // upload file on S3 server
        parent::upload($params['completeFilename'], $format);

        return parent::SUCCESS_RESPONSE;
    }

}
