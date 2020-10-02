<?php

declare(strict_types=1);


namespace App\Component\Algolia\Indexation;

use App\Component\Algolia\AlgoliaConnection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Indexer
{
    public static function populate(EntityManagerInterface $em, OutputInterface $output)
    {
        $client = AlgoliaConnection::connect();

        // configure serializer
        $serializer = self::configureSerializer();
        FilmIndexation::index($em, $serializer, $client, $output);
        sleep(1);
        NumberIndexation::index($em, $serializer, $client, $output);
        sleep(1);
        SongIndexation::index($em, $serializer, $client, $output);
        sleep(1);
        PersonIndexation::index($em, $serializer, $client, $output);
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
