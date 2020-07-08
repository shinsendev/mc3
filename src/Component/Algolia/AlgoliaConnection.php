<?php

declare(strict_types=1);

namespace App\Component\Algolia;

use Algolia\AlgoliaSearch\SearchClient;

/**
 * Class AlgoliaConnection
 * @package App\Component\Algolia
 */
class AlgoliaConnection
{
    public static function connect()
    {
        $client = SearchClient::create(
            $_ENV['ALGOLIA_APP_ID'],
            $_ENV['ALGOLIA_API_KEY'],
        );

        return $client;
    }
}