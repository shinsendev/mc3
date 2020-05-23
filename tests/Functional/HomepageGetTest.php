<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class HomepageGetTest extends AbstractFunctionalTest
{
    public function testGetSong()
    {
        $response = $this->client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        //todo = add tests for performers, films with numbers and films count
    }
}