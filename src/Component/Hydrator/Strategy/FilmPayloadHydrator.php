<?php

declare(strict_types=1);

namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\NumberNestedInFilmDTO;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\Helper\PersonHelper;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class FilmPayloadHydrator implements HydratorDTOInterface
{
    /**
     * @param DTOInterface $dto
     * @param array $data
     * @param EntityManagerInterface $em
     * @return FilmPayloadDTO
     */
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):FilmPayloadDTO
    {
        $params = [];
        // set excludes paramaters to treate manually
        $params['excludes'] = ['numbers', 'studios'];
        $params['mandatory'] = ['uuid', 'title', 'imdb'];

        $data['model'] = 'film';
        /** @var Film $film */
        $film = $data['film'];

        /** @var FilmPayloadDTO $dto */
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        // manage numbers of a film
        if ($film->getNumbers()) {
            // get ordered Numbers (the order is in model film->numbers thanks to doctrine)
            $numbersDTOList = self::getNumbers($film, $em);
            if(count($numbersDTOList) > 0) {
                // add numbers to film
                $dto->setNumbers($numbersDTOList);
            }
        }

        $manyToMany = ['censorship', 'state'];

        // get attributes
        foreach ($film->getAttributes() as $attribute) {

            $code = $attribute->getCategory()->getCode();

            // error
            if ($code === 'structure') {
                //todo : remove structure in import and add it to number
                continue;
            }

            // handle exception
            if ($code === 'verdict') { // is this pca verdict?
                $dto->setPca($attribute->getTitle());
                continue;
            }

            // handle many to many
            if (in_array($code, $manyToMany)) {
                $manyToManyAttributes[$code][] = $attribute->getTitle();
                continue;
            }

            // for all normal many to one
            $setter = 'set'.ucfirst($attribute->getCategory()->getCode());
            $dto->$setter($attribute->getTitle());
        }

        // still for attributes : set many to many
        foreach ($manyToMany as $category) {
            if(isset($manyToManyAttributes[$category])) {
                $setter = 'set'.ucfirst($category.'s'); // be carefull ad change if a word already finish with a s
                $dto->$setter($manyToManyAttributes[$category]);
            }
        }

        // get studios
        $studiosDTO = [];
        foreach($film->getStudios() as $studio) {
            $studiosDTO[] = [
                'name' => $studio->getName(),
                'uuid' => $studio->getUuid()
            ];
        }

        $dto->setStudios($studiosDTO);

        // get directors
        $directors = PersonHelper::getPersonsByProfession('director', ModelConstants::FILM_MODEL, $film, $em);
        $dto->setDirectors($directors);

        // get stats
        // todo: add stats from a stats table

        return $dto;
    }

    /**
     * @param Film $film
     * @param EntityManagerInterface $em
     * @return array
     */
    public static function getNumbers(Film $film, EntityManagerInterface $em)
    {
        // sort numbers by beginTc
        $numbers = $film->getNumbers();
        $numbersDTOList = [];

        // add numbers
        foreach ($numbers as $order => $number) {

            $numberUuid = $number->getUuid();
            $numberBeginTc = $number->getBeginTc();
            $numberEndTc = $number->getEndTc();

            /** @var NumberNestedInFilmDTO $numberDTO */
            $numberDTO = DTOFactory::create(ModelConstants::NUMBER_NESTED_IN_FILM_DTO_MODEL);
            $numberDTO->setOrder($order);
            $numberDTO->setTitle($number->getTitle());
            $numberDTO->setBeginTc($numberBeginTc);
            $numberDTO->setEndTc($numberEndTc);
            $numberDTO->setUuid($numberUuid);

            // compute number length
            if ($numberBeginTc && $numberEndTc && $numberEndTc >= $numberBeginTc) {
                $numberDTO->setLength($numberEndTc - $numberBeginTc);
            }

            //set performers
            $performers = $em->getRepository(Work::class)->findPersonByTargetAndProfession('number', $numberUuid, 'performer');

            $peformersList = [];
            if ($performers) {
                foreach ($performers as $performer) {
                    $personDTO = DTOFactory::create(ModelConstants::PERSON_NESTED_DTO_MODEL);
                    $personDTO->hydrate(['person' => $performer], $em);
                    $peformersList[] = $personDTO;
                }

                $numberDTO->setPerformers($peformersList);
            }

            $numbersDTOList[] = $numberDTO;
        }

        return $numbersDTOList;
    }



}