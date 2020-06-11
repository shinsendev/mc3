<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\DTO\Payload\NumberPayloadDTO;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class NumberPayloadHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return NumberPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):FilmPayloadDTO
    {
        $params = [];
        // set excludes paramaters to treate manually some properties
        $params['excludes'] = ['dubbing', 'film'];
        // fields we are forced to complete, if not we throw an error
        $params['mandatory'] = ['title'];

        $data['model'] = ModelConstants::NUMBER_MODEL;
        /** @var Number $number */
        $number = $data['model'];

        /** @var NumberPayloadDTO $dto */
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        dd($dto);
//
//        // manage numbers of a film
//        if ($film->getNumbers()) {
//            // get ordered Numbers (the order is in model film->numbers thanks to doctrine)
//            $numbersDTOList = self::getNumbers($film, $em);
//            if(count($numbersDTOList) > 0) {
//                // add numbers to film
//                $dto->setNumbers($numbersDTOList);
//            }
//        }
//
//        // configuration for film payload
//        $manyToMany = ['state', 'censorship'];
//
//        // get attributes
//        foreach ($film->getAttributes() as $attribute) {
//            $code = $attribute->getCategory()->getCode();
//
//            // handle exception
//            if ($code === 'verdict') { // is this pca verdict?
//                $dto->setPca($attribute->getTitle());
//                continue;
//            }
//
//            // handle many to many
//            if (in_array($code, $manyToMany)) {
//                $manyToManyAttributes[$code][] = $attribute->getTitle();
//                continue;
//            }
//
//            // for all normal many to one
//            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
//            $dto->$setter($attribute->getTitle());
//        }
//
//
//        // for attributes again: set many to many
//        foreach ($manyToMany as $category) {
//            if(isset($manyToManyAttributes[$category])) {
//                $setter = 'set'.ucfirst($category.'s'); // be carefull, to be changed if a category already finish with a s
//                $dto->$setter($manyToManyAttributes[$category]);
//            }
//        }
//
//        // get studios
//        $studiosDTO = [];
//        foreach($film->getStudios() as $studio) {
//            $studiosDTO[] = [
//                'name' => $studio->getName(),
//                'uuid' => $studio->getUuid()
//            ];
//        }
//
//        $dto->setStudios($studiosDTO);
//
//        // get directors
//        $directors = PersonHelper::getPersonsByProfession('director', ModelConstants::FILM_MODEL, $film, $em);
//        $dto->setDirectors($directors);
//
//        // get stats
//        $dto = self::computeStats($dto, $em);
//
//        return $dto;
    }

}