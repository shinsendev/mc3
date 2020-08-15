<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\Heredity\AbstractImportable;
use App\Repository\IndexationRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Component\DTO\Import\IndexationInputDTO;
use App\Component\DTO\Import\IndexationOutputDTO;

/**
 * @ApiResource(
 *     input=IndexationInputDTO::class,
 *     output=IndexationOutputDTO::class,
 *     collectionOperations={
 *      "get" = { "security" = "is_granted('ACTIVATED_USER')" },
 *      "post" = { "security" = "is_granted('ACTIVATED_USER')" }
 *     },
 *     itemOperations={
 *      "get" = { "security" = "is_granted('ACTIVATED_USER')" }
 *     }
 * )
 * @ORM\Entity(repositoryClass=IndexationRepository::class)
 */
class Indexation extends AbstractImportable
{

}
