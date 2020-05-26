<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Helper;


use App\Component\DTO\Nested\PersonNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Model\ModelConstants;
use App\Entity\Definition\EntityInterface;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class PersonHelper
{
    /**
     * @param string $profession
     * @param string $model
     * @param EntityInterface $entity
     * @param EntityManagerInterface $em
     * @return PersonNestedDTO[]
     */
    public static function getPersonsByProfession(string $profession, string $model, EntityInterface $entity, EntityManagerInterface $em):array
    {
        $persons = $em->getRepository(Work::class)->findPersonByTargetAndProfession($model, $entity->getUuid(), $profession);
        $personsDTO = [];
        foreach ($persons as $person) {
            /** @var PersonNestedDTO $personDTO */
            $personDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $personDTO->hydrate(['person' => $person], $em);
            $personsDTO[] = $personDTO;
        }

        return $personsDTO;
    }
}