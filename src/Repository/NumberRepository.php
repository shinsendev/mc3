<?php

namespace App\Repository;

use App\Entity\Number;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

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
     * @param $attributeUuid
     * @return array|null
     */
    public function getAttributes(int $attributeUuid):?array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT DISTINCT n.title, n.uuid FROM App\Entity\Number n
                INNER JOIN f.attributes a
            WHERE a.uuid = :uuid
        ');
        $query->setParameters([
            'uuid' => $attributeUuid
        ]);

        return $query->getResult();
    }
}
