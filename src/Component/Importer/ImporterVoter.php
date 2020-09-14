<?php

namespace App\Component\Importer;

use App\Component\Error\Mc3Error;
use App\Entity\Heredity\AbstractImportable;
use App\Entity\Import;
use App\Entity\Indexation;
use Doctrine\ORM\EntityManagerInterface;

class ImporterVoter
{
    public static function isAllowed(EntityManagerInterface $em)
    {
        $lastImport = $em->getRepository(Import::class)->getLastImport();
        $lastIndexation = $em->getRepository(Indexation::class)->getLastIndexation();

        // if there is no last import, it means the first migration is an indexation, we have to stop it
        if (!$lastImport) {
            throw new Mc3Error('First migration must be an import (not an indexation).', 403);
        }

        $lastMigration = self::getLastMigration($lastImport, $lastIndexation);

        // if the last migration is finished, no problem, a new migration can be launched
        if (!$lastMigration->getInProgress()) {
            return true;
        }

        // else we have to check if the last migration has finished for more than 45 min (an arbitrary delay)
        if (self::checkInterval($lastMigration->getUpdatedAt())) {
            // if yes we can launch a new migration
            return true;
        }

        // if not we return an error
        throw new Mc3Error('Migration avoided and not created. Another process is already running.', 400);
    }

    /**
     * @param Import $import
     * @param Indexation|null $indexation
     * @return AbstractImportable
     */
    public static function getLastMigration(Import $import, ?Indexation $indexation):AbstractImportable
    {
        // if there is no indexation we return the import as last migration (it means it's the first import)
        if (!$indexation) {
            return $import;
        }
        // else we return the most recent migration
        else if ($import->getCreatedAt() > $indexation->getCreatedAt()) {
            return $import;
        }
        else {
            return $indexation;
        }
    }

    public static function checkInterval(\DateTime $updatedAt)
    {
        $interval = new \DateInterval("PT45M");
        $updatedAt->add($interval);

        if ($updatedAt < new \DateTime()) {
            return true;
        }
    }

}