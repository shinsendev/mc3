<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class SongResourceGetTest extends AbstractFunctionalTest
{
    public function testGetSong()
    {
        $uuid = 'f42bb9a6-09b2-44a8-a887-3f590b93cc03';
        $response = $this->client->request('GET', 'api/songs/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals($arrayResponse['title'], "It's a Grand Night for Singing");
        $this->assertEquals($arrayResponse['year'], 1919);

        // test attribues connected to song (songtype)
        $this->assertEquals(2, count($arrayResponse['songTypes']));
        $this->assertEquals("Ragtime", $arrayResponse['songTypes'][0]['title']);

        // test composers
        //todo: when person is added

        // test lyricists
        //todo: when person is added

        // test numbers
        //todo: add numbers
    }
}