<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

    /**
     * @param $limit
     * @return Paginator
     */
    public function findPopularPersons($limit):Paginator
    {
        // get $limit persons with the most numbers associated
        $dql = '
            SELECT p, COUNT(p.id) as nb FROM App\Entity\Person p
                INNER JOIN p.works w
                GROUP BY p.id
                ORDER BY nb DESC
        ';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }
}
