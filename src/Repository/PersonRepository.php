<?php

namespace App\Repository;

use App\Component\Model\ModelConstants;
use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\DBAL\Driver\PDOException;
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

    /**
     * @param string $personUuid
     * @param int $limit
     * @param int $first
     * @return Paginator
     */
    public function findPaginatedRelatedFilmsBySongs(string $personUuid, int $limit = 100, $first = 0):Paginator
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f FROM App\Entity\Film f 
                JOIN f.numbers n
                JOIN n.songs s
                INNER JOIN App\Entity\Work w WITH w.targetUuid = s.uuid AND w.targetType = :songModel
                JOIN w.person p
                WHERE p.uuid = :personUuid
                GROUP BY f.id');
        $query->setParameters([
            'songModel' => ModelConstants::SONG_MODEL,
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
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function findRelatedNumbersWithNativeSQL(string $personUuid):array
    {
        $dbal = $this->getEntityManager()->getConnection('default');

        $stmt = "SELECT * FROM (SELECT DISTINCT ON(uuid, profession) *  FROM (
          SELECT n.title,
                 n.uuid,
                 w.profession,
                 f.released_year as film_released_year,
                 f.imdb          as film_imdb,
                 f.uuid          as film_uuid,
                 f.title         as film_title
          FROM number n
                   INNER JOIN work w ON w.target_uuid = n.uuid
                   INNER JOIN person p ON p.id = w.person_id
                   INNER JOIN film f ON n.film_id = f.id
            AND p.uuid = :uuid
          UNION
          SELECT n.title,
                 n.uuid,
                 w.profession,
                 f.released_year as film_released_year,
                 f.imdb          as film_imdb,
                 f.uuid          as film_uuid,
                 f.title         as film_title
          FROM person p
                   INNER JOIN work w on p.id = w.person_id
                   INNER JOIN song s ON s.uuid = w.target_uuid
                   INNER JOIN number_song ns on s.id = ns.song_id
                   INNER JOIN number n on ns.number_id = n.id
                   INNER JOIN film f ON n.film_id = f.id
          WHERE p.uuid = :uuid
        ) as UniqueNumbers) orderedUniqueNumbers ORDER BY film_released_year";

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
            ORDER BY w.profession, p.firstname, p.lastname, p.groupname
        ');
        $query->setParameters([
            'personUuid' => $personUuid,
            'targetsList' => $targetsList
        ])
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * @param $personUuid
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function computeAverageShotLength($personUuid):?float
    {
        // to avoid division by zero error, we add 1 shot by default if there is no info
        $query = $this->getEntityManager()->createQuery('
          SELECT (AVG(n.endTc - n.beginTc)/ AVG(CASE WHEN n.shots > 0 THEN n.shots ELSE 1 END)) FROM App\Entity\Number n
            INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid
            INNER JOIN App\Entity\Person p WITH p.id = w.person
           WHERE w.profession = :performer AND p.uuid = :personUuid
    ')
            ->setParameters([
                'personUuid' => $personUuid,
                'performer' => 'performer'
            ]);

        return $query->getSingleScalarResult();
    }

    /**
     * @param string $personUuid
     * @return int|mixed|string
     */
    public function findFilmsWherePerforming(string $personUuid)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f FROM App\Entity\Film f JOIN f.numbers n
                INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid
                INNER JOIN App\Entity\Person p WITH p.id = w.person
            WHERE w.profession = :performer AND p.uuid = :personUuid
            GROUP BY f.id
            ORDER BY f.releasedYear
        ')
        ->setParameters([
            'personUuid' => $personUuid,
            'performer' => 'performer'
        ]);

        return $query->getResult();
    }

    public function findNumbersWherePerforming(string $personUuid)
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT n.uuid FROM App\Entity\Number n
                INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid
                INNER JOIN App\Entity\Person p WITH p.id = w.person
            WHERE w.profession = :performer AND p.uuid = :personUuid
            GROUP BY n.id
        ')
            ->setParameters([
                'personUuid' => $personUuid,
                'performer' => 'performer'
            ]);

        return $query->getResult();
    }

    public function findChoreographers(array $numbers)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p, n FROM App\Entity\Person p 
                INNER JOIN App\Entity\Work w WITH p.id = w.person
                INNER JOIN App\Entity\Number n WITH w.targetUuid = n.uuid
            WHERE w.profession = :choregraph AND n.uuid IN (:numbers)
        ")
            ->setParameters([
                'choregraph' => 'choregraph',
                'numbers' => $numbers
            ]);

        return $query->getResult();
    }

    public function findChoreographersGroupedByNumbers(array $numbers)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p as person, COUNT(n.id) as count FROM App\Entity\Person p 
                INNER JOIN App\Entity\Work w WITH p.id = w.person
                INNER JOIN App\Entity\Number n WITH w.targetUuid = n.uuid
            WHERE w.profession = :profession AND n.uuid IN (:numbers)
            GROUP BY p.id ORDER BY count DESC
        ")
            ->setParameters([
                'profession' => 'choregraph',
                'numbers' => $numbers
            ]);

        return $query->getResult();
    }

    /**
     * @param array $numbers
     * @return int|mixed|string
     */
    public function findSongCoworkersGroupedByNumbers(array $numbers, string $profession)
    {
        $query = $this->getEntityManager()->createQuery("
            SELECT p as person, COUNT(s.id) as count FROM App\Entity\Person p
                INNER JOIN App\Entity\Work w WITH p.id = w.person
                INNER JOIN App\Entity\Song s WITH s.uuid = w.targetUuid
                JOIN s.numbers n
            WHERE w.profession = :profession AND n.uuid IN (:numbers)
            GROUP BY p.id ORDER BY count DESC
        ")
            ->setParameters([
                'profession' => $profession,
                'numbers' => $numbers
            ]);

        return $query->getResult();
    }


}
