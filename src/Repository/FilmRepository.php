<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    /**
     * FilmRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException`
     */
    public function countFilms():int
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT COUNT(f.uuid) FROM App\Entity\Film f
        ');
        return $query->getSingleScalarResult();
    }

    /**
     * @return int
     */
    public function countFilmsWithNumbers():int
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT COUNT(DISTINCT (f.uuid)) FROM App\Entity\Film f JOIN f.numbers n
        ');
        return $query->getSingleScalarResult();
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function findPaginatedFilmsWithNumbers(int $limit, int $offset):Paginator
    {
        $dql = "SELECT f FROM App\Entity\Film f JOIN f.numbers n";
        $query = $this->getEntityManager()->createQuery($dql)
            ->setFirstResult(0)
            ->setMaxResults(10);

        return new Paginator($query, $fetchJoinCollection = true);
    }

    /**
     * @param string $attributeUuid
     * @return int|null
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAttributes(string $attributeUuid):?int
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT COUNT(DISTINCT f.uuid) FROM App\Entity\Film f
                INNER JOIN f.attributes a
            WHERE a.uuid = :uuid
        ');
        $query->setParameters([
            'uuid' => $attributeUuid
        ]);

        return $query->getSingleScalarResult();
    }

    /**
     * @param string $attributeUuid
     * @return array|null
     */
    public function getAttributes(string $attributeUuid):?array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT DISTINCT f.title, f.uuid, \'film\' as model FROM App\Entity\Film f
                INNER JOIN f.attributes a
            WHERE a.uuid = :uuid
        ');
        $query->setParameters([
            'uuid' => $attributeUuid
        ]);

        return $query->getResult();
    }
}
