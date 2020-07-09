<?php

declare(strict_types=1);


namespace App\Component\Elastic\Indexation;

use App\Component\Elastic\ElasticConnection;
use App\Component\Model\ModelConstants;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class Indexer
 * @package App\Component\Elastic\Indexation
 */
class Indexer
{
    /**
     * @param EntityManagerInterface $em
     * @param OutputInterface $output
     */
    public static function populate(EntityManagerInterface $em, OutputInterface $output)
    {
        $client = ElasticConnection::connect();
        ini_set('memory_limit', '256M'); //because of php array adapter cache

        // In some rare cases, you may see an error like this when attempting to alter an index:
        // "Cannot delete indices that are being snapshotted: [[my_index/dPzLciT9RlmS8OtGGm61IQ]]. Try again after snapshot finishes or cancel the currently running snapshot."
        // The solution is to wait a minute or two and try again.
        // https://docs.bonsai.io/article/137-snapshots-on-bonsai

        // configure serializer
        $serializer = self::configureSerializer();

        // reset and create index
        $indexParams['index']  = ModelConstants::FILM_MODEL;
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);
        FilmIndexation::index($em, $serializer, $client, $output);

        // reset and create index
        $indexParams['index']  = ModelConstants::NUMBER_MODEL;
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);
        NumberIndexation::index($em, $serializer, $client, $output);

        // reset and create index
        $indexParams['index']  = ModelConstants::PERSON_MODEL;
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);
        PersonIndexation::index($em, $serializer, $client, $output);

        // reset and create index
        $indexParams['index']  = ModelConstants::SONG_MODEL;
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);
        SongIndexation::index($em, $serializer, $client, $output);
    }

    public static function createIndexes()
    {
        $client = ElasticConnection::connect();

        $indexParams['index']  = ModelConstants::FILM_MODEL;
        $client->indices()->create($indexParams);

        $indexParams['index']  = ModelConstants::NUMBER_MODEL;
        $client->indices()->create($indexParams);

        $indexParams['index']  = ModelConstants::PERSON_MODEL;
        $client->indices()->create($indexParams);

        $indexParams['index']  = ModelConstants::SONG_MODEL;
        $client->indices()->create($indexParams);
    }

    public static function delete()
    {
        $client = ElasticConnection::connect();

        $indexParams['index']  = ModelConstants::FILM_MODEL;
        $client->indices()->delete($indexParams);

        $indexParams['index']  = ModelConstants::NUMBER_MODEL;
        $client->indices()->delete($indexParams);

        $indexParams['index']  = ModelConstants::PERSON_MODEL;
        $client->indices()->delete($indexParams);

        $indexParams['index']  = ModelConstants::SONG_MODEL;
        $client->indices()->delete($indexParams);
    }


    /**
     * @return Serializer
     */
    protected static function configureSerializer()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}