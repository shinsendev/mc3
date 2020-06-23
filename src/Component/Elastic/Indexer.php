<?php

declare(strict_types=1);


namespace App\Component\Elastic;


use App\Component\Model\ModelConstants;
use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;

class Indexer
{
    public static function populate(EntityManagerInterface $em)
    {
        $client = ElasticConnection::connect();

        // reset indexes

        // create index
        // todo: check if already exists
        $indexParams['index']  = 'mc2';
        $client->indices()->delete($indexParams);
        $client->indices()->create($indexParams);

        // foreach films, index it // just pass em
        $films = $em->getRepository(Film::class)->findAll();

        foreach ($films as $film) {
            $data = [
                'title' => $film->getTitle(),
                'realeasedYear' => $film->getReleasedYear(),
                'id' => $film->getUuid(),
            ];

            $params['body']  = $data;
            $params['index'] = 'mc2';
            $params['type']  = ModelConstants::FILM_MODEL;
            $params['id']    = $film->getUuid();

            $ret = $client->index($params);
        }

        dd($ret);
    }
}