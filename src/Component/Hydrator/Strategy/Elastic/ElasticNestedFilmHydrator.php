<?php


namespace App\Component\Hydrator\Strategy\Elastic;


use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\Elastic\ElasticFilmNestedDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Strategy\NestedPersonPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Number;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class ElasticNestedFilmHydrator implements HydratorDTOInterface
{
    /**
     * @param ElasticFilmNestedDTO $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return ElasticFilmNestedDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em)
    {
        /** @var Film $film */
        $film = $data['film'];

        $dto->setReleasedYear($film->getReleasedYear()); // todo: convert into date
        $dto->setSample($film->getSample());

        if ($directors = $em->getRepository(Work::class)->findPersonByTargetAndProfession('film', $film->getUuid(),'director')) {
            $dto->setDirectors(self::setPeople($directors, $em));
        }

        // set attributes
        
//    $dto->setAdaptation($film->getAdaptation()); // string
//    private array $filmCensorships = [];
//    private array $legion = [];
//    private array $pca = [];
//    private array $states = [];
//    private array $studios = [];

        // TODO: Implement hydrate() method.

        return $dto;
    }

    public static function setPeople($people, EntityManagerInterface $em)
    {
        $peopleList = [];
        foreach ($people as $person) {
            $personDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
            $peopleList[] = NestedPersonPayloadHydrator::hydrate($personDTO, ['person' => $person], $em);
        }

        return $peopleList;
    }

}