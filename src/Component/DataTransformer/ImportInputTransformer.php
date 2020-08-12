<?php


namespace App\Component\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Component\DTO\Import\ImportInputDTO;
use App\Entity\Import;
use Ramsey\Uuid\Uuid;

class ImportInputTransformer implements DataTransformerInterface
{
    public function transform($importDTO, string $to, array $context = [])
    {
        // convert ImportDTO into Import object
        $import = new Import();
        $import->setUuid(Uuid::uuid4()->toString());
        $import->setStatus(Import::STARTED_STATUS);
        $import->setInProgress(true);

        return $import;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // no transformation needed if it's already an import object and not a DTO
        if ($data instanceof ImportInputDTO) {
            return false;
        }

        return Import::class === $to;
    }

}