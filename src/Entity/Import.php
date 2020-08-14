<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Component\DTO\Import\ImportInputDTO;
use App\Component\DTO\Import\ImportOutputDTO;
use App\Entity\Heredity\AbstractImportable;
use App\Repository\ImportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     input=ImportInputDTO::class,
 *     output=ImportOutputDTO::class,
 *     collectionOperations={
 *      "get" = { "security" = "is_granted('ACTIVATED_USER')" },
 *      "post" = { "security" = "is_granted('ACTIVATED_USER')" }
 *     },
 *     itemOperations={
 *      "get" = { "security" = "is_granted('ACTIVATED_USER')" }
 *     }
 * )
 * @ORM\Entity(repositoryClass=ImportRepository::class)
 */
class Import extends AbstractImportable
{

}
