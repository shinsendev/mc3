<?php

declare(strict_types=1);

namespace App\Entity\Relation;

use App\Entity\Heredity\AbstractRelation;
use App\Entity\Thesaurus;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Qualification extends AbstractRelation
{
    // add unicity rule for the three properties

    /** @var Thesaurus */
    private $thesaurus;
}
