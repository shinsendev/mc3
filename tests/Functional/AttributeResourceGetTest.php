<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class AttributeResourceGetTest extends AbstractFunctionalTest
{
    public function testGetSong()
    {
        $uuid = '';
        $response = $this->client->request('GET', 'api/attributes/'.$uuid);
        $this->assertResponseIsSuccessful();


        $arrayResponse = $response->toArray();
        $this->assertEquals($arrayResponse['title'], "It's a Grand Night for Singing");
        $this->assertEquals($arrayResponse['year'], 1919);
    }
}