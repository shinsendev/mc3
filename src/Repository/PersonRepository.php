<?php

namespace App\Repository;

use App\Component\Model\ModelConstants;
use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;

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
        $query = $this->getEntityManager()->createQuery('
            SELECT f FROM App\Entity\Film f 
                INNER JOIN App\Entity\Work w WITH w.targetUuid = f.uuid AND w.targetType = :filmModel
                JOIN w.person p
                WHERE w.targetType = :filmModel AND p.uuid = :personUuid');
        $query->setParameters([
            'filmModel' => ModelConstants::FILM_MODEL,
            'personUuid' => $personUuid
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * @param string $personUuid
     * @param int $limit
     * @param int $first
     * @return Paginator
     */
    public function findPaginatedRelatedFilmsByNumbers(string $personUuid, int $limit = 100, $first = 0):Paginator
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f FROM App\Entity\Film f 
                JOIN f.numbers n
                INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid AND w.targetType = :numberModel
                JOIN w.person p
                WHERE w.targetType = :numberModel AND p.uuid = :personUuid
                GROUP BY f.id');
        $query->setParameters([
            'numberModel' => ModelConstants::NUMBER_MODEL,
            'personUuid' => $personUuid
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /***
     * Warning ! Not the correct result
     *
     * @param string $personUuid
     * @param int $limit
     * @param int $first
     * @return Paginator
     */
    public function findPaginatedRelatedNumbers(string $personUuid, int $limit = 100, $first = 0):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT n as number, w.profession FROM App\Entity\Number n
                INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid AND w.targetType = :numberModel
                INNER JOIN App\Entity\Person p WITH p.id = w.person
            WHERE w.targetType = :numberModel AND p.uuid = :personUuid
        ');
        $query->setParameters([
            'numberModel' => ModelConstants::NUMBER_MODEL,
            'personUuid' => $personUuid
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * @param string $personUuid
     * @param int $limit
     * @param int $first
     * @return array
     */
    public function findRelatedNumbersWithNativeSQL(string $personUuid):array
    {
        $dbal = $this->getEntityManager()->getConnection('default');

        $stmt = "SELECT n.title, n.uuid, w.profession, f.released_year as film_released_year, f.imdb as film_imdb, f.uuid as film_uuid, f.title as film_title FROM number n
    INNER JOIN work w ON w.target_uuid = n.uuid AND w.target_type = 'number'
    INNER JOIN person p ON p.id = w.person_id
    INNER JOIN film f ON n.film_id = f.id
    WHERE w.target_type = 'number' AND p.uuid = :uuid
ORDER BY f.released_year, f.title";

        $rsl = $dbal->prepare($stmt);
        $rsl->execute(['uuid' => $personUuid]);

        return  $rsl->fetchAll();
    }

    /**
     * @param string $personUuid
     * @param array $targetsList
     * @param int $limit
     * @param int $first
     * @return Paginator
     */
    public function findPaginatedRelatedPersons(string $personUuid, array $targetsList, int $limit = 100, $first = 0):Paginator
    {
        $query = $this->getEntityManager()->createQuery('
           SELECT p as person, w.profession as profession  FROM App\Entity\Person p
                INNER JOIN App\Entity\Work w WITH w.person = p.id
            WHERE w.targetUuid IN (:targetsList)
            AND p.uuid != :personUuid
        ');
        $query->setParameters([
            'personUuid' => $personUuid,
            'targetsList' => $targetsList
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

}
