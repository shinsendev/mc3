<?php

namespace App\Repository;

use App\Entity\Person;
use App\Entity\Work;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Work|null find($id, $lockMode = null, $lockVersion = null)
 * @method Work|null findOneBy(array $criteria, array $orderBy = null)
 * @method Work[]    findAll()
 * @method Work[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Work::class);
    }

    public function findPersonByTargetAndProfession(string $model, string $targetUuid, string $profession):array
    {
        $dql = '
            SELECT p FROM App\Entity\Person p
                JOIN p.works w 
            WHERE w.targetUuid = :target 
            AND w.targetType = :model 
            AND w.profession = :profession
        ';
       $query = $this->getEntityManager()->createQuery($dql);
       $query->setParameters([
           'model' => $model,
           'target' => $targetUuid,
           'profession' => $profession
       ]);

       return $query->getResult();
    }

    /**
     * @param Person $person
     * @return array
     */
    public function findProfessionsByPerson(Person $person):array
    {
        $dql = 'SELECT DISTINCT(w.profession) as profession FROM App\Entity\Work w WHERE w.person =:person';
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameters([
            'person' => $person
        ]);
        return $query->getResult();
    }

}
