<?php

namespace App\Repository;

use App\Entity\Attribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribute[]    findAll()
 * @method Attribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
    }

    /**
     * @param string $code
     * @return int|mixed|string
     */
    public function findAttributesByCategory(string $code):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT a FROM App\Entity\Attribute a JOIN a.category c WHERE c.code = :code 
        ')->setParameters(['code' => $code]);
        return $query->getResult();
    }

    /**
     * @return int|mixed|string
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countAttributes()
    {
        $query = $this->getEntityManager()->createQuery('SELECT COUNT(n.id) FROM App\Entity\Attribute n');
        return $query->getSingleScalarResult();
    }

    /**
     * @param string $type
     * @return int|mixed|string
     */
    public function computeAveragesForType(string $type):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT a.title, a.uuid, c.uuid as categoryUuid, c.code as categoryCode, COUNT(a.uuid) as average FROM App\Entity\Number n 
                JOIN n.attributes a
                JOIN a.category c
                WHERE c.code = :code
                GROUP BY a.title, a.uuid, c.uuid, c.code
        ');

        $query->setParameters(['code' => $type]);

        return $query->getResult();
    }

    /**
     * @param string $type
     * @param string $personUuid
     * @return int|mixed|string
     */
    public function computeAveragesForTypeAndPerson(string $type, string $personUuid):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT a.title, a.uuid, c.uuid as categoryUuid, c.code as categoryCode, COUNT(a.uuid) as current FROM App\Entity\Number n 
                JOIN n.attributes a
                JOIN a.category c
                INNER JOIN App\Entity\Work w WITH w.targetUuid = n.uuid
                INNER JOIN App\Entity\Person p WITH p.id = w.person
                WHERE c.code = :code AND p.uuid = :personUuid AND w.profession = :performer
                GROUP BY a.title, a.uuid, c.uuid, c.code
        ');

        $query->setParameters([
            'code' => $type,
            'personUuid' => $personUuid,
            'performer' => 'performer'
        ]);

        return $query->getResult();
    }

    /**
     * @param string $attributeUuid
     * @return int|mixed|string
     */
    public function countAttributeFilmsByYears(string $attributeUuid):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f.releasedYear, COUNT(f.releasedYear) as count FROM App\Entity\Film f 
                JOIN f.attributes a
                WHERE a.uuid = :attributeUuid
                GROUP BY f.releasedYear
        ');

        $query->setParameters([
            'attributeUuid' => $attributeUuid,
        ]);

        return $query->getResult();
    }

    /**
     * @param string $attributeUuid
     * @return array
     */
    public function countAttributeNumbersByYears(string $attributeUuid):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f.releasedYear, COUNT(f.releasedYear) as count FROM App\Entity\Film f
                JOIN f.numbers n
                JOIN n.attributes a
                WHERE a.uuid = :attributeUuid
                GROUP BY f.releasedYear
        ');

        $query->setParameters([
            'attributeUuid' => $attributeUuid,
        ]);

        return $query->getResult();
    }

    /**
     * @param string $attributeUuid
     * @return array
     */
    public function countAttributeSongsByYears(string $attributeUuid):array
    {
        $query = $this->getEntityManager()->createQuery('
            SELECT f.releasedYear, COUNT(f.releasedYear) as count FROM App\Entity\Film f
                JOIN f.numbers n
                JOIN n.songs s
                JOIN s.attributes a
                WHERE a.uuid = :attributeUuid
                GROUP BY f.releasedYear
        ');

        $query->setParameters([
            'attributeUuid' => $attributeUuid,
        ]);

        return $query->getResult();
    }
}
