<?php

namespace App\Repository;

use App\Entity\Song;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Song|null find($id, $lockMode = null, $lockVersion = null)
 * @method Song|null findOneBy(array $criteria, array $orderBy = null)
 * @method Song[]    findAll()
 * @method Song[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SongRepository extends ServiceEntityRepository
{
    /**
     * SongRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Song::class);
    }

    /**
     * @param $uuid
     * @param int $first
     * @param int $max
     * @return \Doctrine\ORM\Query
     */
    public function getFilmsQuery($uuid, $first = 0, $max = 100): Query
    {
        return $this->getEntityManager()->createQuery('
            SELECT f FROM App\Entity\Film f
                INNER JOIN f.numbers n
                INNER JOIN n.songs s
            WHERE s.uuid = :uuid
            GROUP BY f.id
        ')
            ->setParameters([
            'uuid' => $uuid
        ])
            ->setFirstResult($first)
            ->setMaxResults($max);
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
            SELECT COUNT(DISTINCT s.uuid) FROM App\Entity\Song s
                INNER JOIN s.attributes a
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
            SELECT DISTINCT s.title, s.uuid, \'song\' as model FROM App\Entity\Song s
                INNER JOIN s.attributes a
            WHERE a.uuid = :uuid
        ');
        $query->setParameters([
            'uuid' => $attributeUuid
        ]);

        return $query->getResult();
    }
}
