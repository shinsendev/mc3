<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class FilmResourceGetTest extends AbstractFunctionalTest
{
    public function testGetFilm()
    {
        $uuid = '18d2c4f3-e16b-4885-908c-46f7e2cd8e38';
        $response = $this->client->request('GET', 'api/films/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals($arrayResponse['title'], "West Side Story");
        $this->assertEquals($arrayResponse['productionYear'], 1962);
        $this->assertEquals($arrayResponse['releasedYear'], 1961);
        $this->assertEquals($arrayResponse['imdb'], 'tt0055614');
        $this->assertEquals(count($arrayResponse['censorships']), 3);
        $this->assertEquals($arrayResponse['length'], 6000);
    }
}