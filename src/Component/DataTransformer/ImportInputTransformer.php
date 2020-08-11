<?php


namespace App\Component\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Component\DTO\Import\ImportInputDTO;
use App\Entity\Import;

class ImportInputTransformer implements DataTransformerInterface
{
    public function transform($importDTO, string $to, array $context = [])
    {
        // supposed to convert DTO into entity before persisting
//        dd('ici');

        $import = new Import();
        return ["import" => $import, "accessKey" => $importDTO->getAccessToken()];
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