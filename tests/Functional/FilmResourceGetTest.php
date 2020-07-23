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
        $this->assertEquals("West Side Story", $arrayResponse['title']);
        $this->assertEquals(1962, $arrayResponse['productionYear']);
        $this->assertEquals(1961, $arrayResponse['releasedYear'] );
        $this->assertEquals('tt0055614', $arrayResponse['imdb']);
        $this->assertCount(3, $arrayResponse['censorships']);
        $this->assertEquals('dialogue', $arrayResponse['censorships'][0]['title']);
        $this->assertEquals(6000, $arrayResponse['length']);
        $this->assertCount(1, $arrayResponse['studios']);
        $this->assertEquals('MGM',$arrayResponse['studios'][0]['name']);
        $this->assertEquals([],$arrayResponse['pca']);
    }

}