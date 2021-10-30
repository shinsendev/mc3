<?php

namespace App\Repository;

use App\Entity\Stageshow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stageshow|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stageshow|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stageshow[]    findAll()
 * @method Stageshow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageshowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stageshow::class);
    }

    // /**
    //  * @return Stageshow[] Returns an array of Stageshow objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stageshow
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
