<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;


use App\Component\Factory\DTOFactory;
use App\Component\Hydrator\Strategy\FilmPayloadHydrator;
use App\Component\Model\ModelConstants;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Elasticsearch\Client;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;

/**
 * Class FilmIndexation
 * @package App\Component\Elastic\Indexation
 */
class FilmIndexation implements IndexationInterface
{
    const INDEX_NAME = 'mc2';

    public static function index(EntityManagerInterface $em, Serializer $serializer, $client, OutputInterface $output)
    {
        $output->writeln([
            'Films indexation',
            '============',
            '',
        ]);

        $limit = 100;
        $offset = 0;
        $index = $client->initIndex(self::INDEX_NAME);
        $index->clearObjects();

        $filmsCount = $em->getRepository(Film::class)->countFilms();
        $turns = ceil($filmsCount / $limit);

        $progressBar = new ProgressBar($output, $filmsCount);

        for ($i = 0; $i < $turns; $i++) {
            $films = $em->getRepository(Film::class)->findPaginatedFilms($limit, $offset);

            foreach ($films as $film) {
                $filmDTO = DTOFactory::create(ModelConstants::FILM_PAYLOAD_MODEL);
                $filmDTO = FilmPayloadHydrator::hydrate($filmDTO, ['film' => $film], $em);

                $filmArray = $serializer->normalize($filmDTO);
                $filmArray['modelType'] = ModelConstants::FILM_MODEL;
                $filmArray['objectID'] = $filmDTO->getUuid();
                $index->saveObject($filmArray);

                $progressBar->advance();
            }

            $offset += $limit;

            if ($limit >$filmsCount) {
                $offset = $filmsCount;
            }
        }

        $progressBar->finish();

        $output->writeln([
            '',
            '============',
            'End of film indexation',
        ]);
    }
}