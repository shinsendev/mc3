<?php


namespace App\Component\Importer;


use App\Component\Error\Mc3Error;
use App\Entity\Import;
use App\Entity\Indexation;
use Doctrine\ORM\EntityManagerInterface;

class ImporterVoter
{
    public static function isAllowed(EntityManagerInterface $em)
    {
        $lastImport = $em->getRepository(Import::class)->getLastImport();
        $lastIndexation = $em->getRepository(Indexation::class)->getLastIndexation();

        // if time is more than 45 min, we let a new process starts but we update the in progress indexation or import to error status if there are still running
        if ($lastImport && $lastIndexation) {
            // if there is no process in progress, we can start a new process
            if ($lastIndexation->getInProgress() == false && $lastImport->getInProgress() == false) {
                return true;
            }
            else {
                // if it more time than interval for the last import and the last indexation we can exceptionnally proceed
                if (self::checkInterval($lastImport->getUpdatedAt()) && self::checkInterval($lastIndexation->getUpdatedAt())) {
                    return true;
                }
                throw new Mc3Error('Import avoided and not created. Another process is already running.', 400);
            }
        }

        if ($lastImport && !$lastIndexation) {
            if ($lastImport->getInProgress()) {
                if (self::checkInterval($lastImport->getUpdatedAt())) {
                    return true;
                }
                throw new Mc3Error('Import avoided and not created. Another process (import) is already running.', 400);
            }
        }

        // very strange condition, but an user might launch the indexation before an import
        if ($lastIndexation && !$lastImport) {
            if ($lastIndexation->getInProgress()) {
                if (self::checkInterval($lastIndexation->getUpdatedAt())) {
                    return true;
                }
                throw new Mc3Error('Import avoided and not created. Another process (indexation) is already running.', 400);
            }
        }

        return true;
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