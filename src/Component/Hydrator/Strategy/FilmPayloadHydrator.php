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
        $dto = HydratorBasics::hydrateDTOBase($dto, $data, $params);

        // get Numbers
        if ($data['film']->getNumbers()) {

            // sort numbers by beginTc
            // todo : return a sort array of numbers

            $numbers = $data['film']->getNumbers();

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

                //performers
                $em->getRepository(Work::class)->findPersonByTargetAndProfession('number', $numberUuid, 'performer');
                // todo : select all performers for number uuid = $number->getUuid()

                dd($numberDTO);
            }
        }

        dd($numbers);

        return $dto;
    }
}