<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class NumberResourceGetTest extends AbstractFunctionalTest
{
    public function testGetNumber()
    {
        $uuid = '5d5bee4b-3fab-4c65-b045-9b116b218d4c';
        $response = $this->client->request('GET', 'api/numbers/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
//        dd($arrayResponse);
//        $this->assertEquals("West Side Story", $arrayResponse['title']);
//        $this->assertEquals(1962, $arrayResponse['productionYear']);
//        $this->assertEquals(1961, $arrayResponse['releasedYear'] );
//        $this->assertEquals('tt0055614', $arrayResponse['imdb']);
//        $this->assertEquals(3, count($arrayResponse['censorships']));
//        $this->assertEquals(6000, $arrayResponse['length']);
//        $this->assertEquals(1, count($arrayResponse['studios']));
//        $this->assertEquals('MGM',$arrayResponse['studios'][0]['name']);
    }
}