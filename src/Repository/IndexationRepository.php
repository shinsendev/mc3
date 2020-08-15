<?php

namespace App\Repository;

use App\Entity\Heredity\AbstractImportable;
use App\Entity\Indexation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Indexation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indexation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indexation[]    findAll()
 * @method Indexation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndexationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Indexation::class);
    }

    public function getLastIndexation()
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT i FROM App\Entity\Indexation i ORDER BY i.id DESC
        ')->setMaxResults(1);

        return $query->getOneOrNullResult();
    }

    public function updateLastIndexation(Indexation $indexation)
    {
        $query = $this->getEntityManager()->createQuery('
            UPDATE App\Entity\Indexation i SET i.inProgress = false, i.status = :status, i.updatedAt = CURRENT_TIMESTAMP() WHERE i.id = :indexation
        ')
        ->setParameters([
            'indexation'=> $indexation,
            'status' => AbstractImportable::SUCCESS_STATUS
        ]);

        return $query->execute();
    }
}
