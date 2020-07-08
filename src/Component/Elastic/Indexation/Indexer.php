<?php

declare(strict_types=1);


namespace App\Component\Elastic\Indexation;

use App\Component\Elastic\ElasticConnection;
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

        // reset and create index

        // In some rare cases, you may see an error like this when attempting to alter an index:
        // "Cannot delete indices that are being snapshotted: [[my_index/dPzLciT9RlmS8OtGGm61IQ]]. Try again after snapshot finishes or cancel the currently running snapshot."
        // The solution is to wait a minute or two and try again.
        // https://docs.bonsai.io/article/137-snapshots-on-bonsai
        $indexParams['index']  = 'mc2';
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);

        // configure serializer
        $serializer = self::configureSerializer();

        // foreach films, index it // just pass em
        FilmIndexation::index($em, $serializer, $client, $output);
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