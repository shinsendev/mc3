<?php

declare(strict_types=1);


namespace App\Component\Hydrator\Strategy;

use App\Component\DTO\Definition\DTOInterface;
use App\Component\DTO\Nested\NumberNestedInFilmDTO;
use App\Component\DTO\Payload\FilmPayloadDTO;
use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Description\HydratorDTOInterface;
use App\Component\Hydrator\HydratorBasics;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use App\Entity\Work;
use Doctrine\ORM\EntityManagerInterface;

class FilmPayloadHydrator implements HydratorDTOInterface
{
    public static function hydrate(DTOInterface $dto, array $data, EntityManagerInterface $em):FilmPayloadDTO
    {
        $params = [];
        // set excludes paramaters to treate manually
        $params['excludes'] = ['numbers'];
        $params['mandatory'] = ['uuid', 'title', 'imdb'];

        $data['model'] = 'film';
        /** @var Film $film */
        $film = $data['film'];

        /** @var FilmPayloadDTO $dto */
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        // get ordered Numbers (the order is in model film->numbers thanks to doctrine)
        if ($film->getNumbers()) {

            // sort numbers by beginTc
            $numbers = $data['film']->getNumbers();

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

            if(isset($numbersDTOList) && count($numbersDTOList) > 0) {
                // add numbers to film
                $dto->setNumbers($numbersDTOList);
            }
        }

        return $dto;
    }

}