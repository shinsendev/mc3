<?php

namespace App\Repository;

use App\Component\Model\ModelConstants;
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
     * @param int $limit
     * @param string $profession
     * @return Paginator
     */
    public function findPaginatedPopularPersonsByJob(int $limit, string $profession):Paginator
    {
        // get $limit persons with the most numbers associated
        $dql = '
            SELECT p as person, COUNT(p.id) as nb FROM App\Entity\Person p
                INNER JOIN p.works w
                WHERE w.profession = :job
                GROUP BY p.id
                ORDER BY nb DESC
        ';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameters([
                'job' => $profession
            ])
            ->setFirstResult(0)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countPersons()
    {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(p.id) FROM App\Entity\Person p');
        return $query->getSingleScalarResult();
    }

    /**
     * @param string $personUuid
     * @param int $limit
     * @param int $first
     * @return Paginator
     */
    public function findPaginatedRelatedFilms(string $personUuid, int $limit = 100, $first = 0):Paginator
    {
        $query = $this->getEntityManager()->createQuery('SELECT f FROM App\Entity\Film f INNER JOIN App\Entity\Work w WITH w.targetUuid = f.uuid AND w.targetType = :model JOIN w.person p WHERE w.targetType = :model AND p.uuid = :personUuid');
        $query->setParameters([
            'model' => ModelConstants::FILM_MODEL,
            'personUuid' => $personUuid
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }
}
