<?php

declare(strict_types=1);


namespace App\Component\Elastic;


use Elasticsearch\ClientBuilder;

class ElasticConnection
{
    public static function connect()
    {
        // This is effectively equal to: "https://username:password!#$?*abc@foo.com:9200/elastic"
        $hosts = [$_ENV['BONSAI_KEY']];
        $client = ClientBuilder::create()           // Instantiate a new ClientBuilder
        ->setHosts($hosts)      // Set the hosts
        ->build();

        return $client;
    }
}