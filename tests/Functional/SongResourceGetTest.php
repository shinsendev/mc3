<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class SongResourceGetTest extends AbstractFunctionalTest
{
    public function testGetSong()
    {
        $uuid = 'f42bb9a6-09b2-44a8-a887-3f590b93cc03';
        $response = $this->client->request('GET', 'api/songs/'.$uuid.'.json');
        $this->assertResponseIsSuccessful();


        $arrayResponse = $response->toArray();
        $this->assertEquals($arrayResponse['title'], "It's a Grand Night for Singing");
        $this->assertEquals($arrayResponse['year'], 1919);
    }
}