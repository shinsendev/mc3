<?php


namespace App\Component\DataTransformer;


use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Component\DTO\Import\IndexationInputDTO;
use App\Entity\Heredity\AbstractImportable;
use App\Entity\Import;
use App\Entity\Indexation;
use Ramsey\Uuid\Uuid;

class IndexationInputTransformer implements DataTransformerInterface
{
    public function transform($object, string $to, array $context = [])
    {
        // convert ImportDTO into Import object
        $import = new Indexation();
        $import->setUuid(Uuid::uuid4()->toString());
        $import->setStatus(AbstractImportable::STARTED_STATUS);
        $import->setInProgress(true);

        return $import;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // no transformation needed if it's already an import object and not a DTO
        if ($data instanceof IndexationInputDTO) {
            return false;
        }

        return Indexation::class === $to;
    }



}