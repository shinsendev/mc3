<?php

namespace App\Repository;

use App\Component\Model\ModelConstants;
use App\Entity\Number;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Number|null find($id, $lockMode = null, $lockVersion = null)
 * @method Number|null findOneBy(array $criteria, array $orderBy = null)
 * @method Number[]    findAll()
 * @method Number[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Number::class);
    }

    /**
     * @param $attributeUuid
     * @return int|null
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAttributes($attributeUuid):?int
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT COUNT(DISTINCT n.uuid) FROM App\Entity\Number n
                INNER JOIN n.attributes a
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
            SELECT n.title, n.uuid, \'number\' as model FROM App\Entity\Number n
                INNER JOIN n.attributes a
            WHERE a.uuid = :uuid
            GROUP BY n.title, n.uuid
        ');
        $query->setParameters([
            'uuid' => $attributeUuid,
        ]);

        return $query->getResult();
    }

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countNumbers()
    {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(n.id) FROM App\Entity\Number n');
        return $query->getSingleScalarResult();
    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalNumbersLength()
    {
        $query = $this->getEntityManager()->createQuery('SELECT SUM(n.endTc-n.beginTc) FROM App\Entity\Number n');
        return $query->getSingleScalarResult();
    }

    /**
     * @param string $numberUuid
     * @return int|null
     */
    public function getFilmReleasedYear(string $numberUuid):?int
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f.releasedYear FROM App\Entity\Number n
                JOIN n.film f
            WHERE n.uuid = :uuid
        ');
        $query->setParameters([
            'uuid' => $numberUuid
        ]);

        return $query->getSingleScalarResult();
    }
}
