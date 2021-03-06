<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class NumberResourceGetTest extends AbstractFunctionalTest
{
    public function testGetNumberOpening()
    {
        $uuid = '5d5bee4b-3fab-4c65-b045-9b116b218d4c';
        $response = $this->client->request('GET', 'api/numbers/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals('Overture', $arrayResponse['title']);
        $this->assertEquals(22, $arrayResponse['startingTc']);
        $this->assertEquals(301, $arrayResponse['endingTc']);
    }

    public function testGetNumberPrologue()
    {
        $uuid = 'ec1b17fd-1578-4c69-a52a-094bf4c7b078';
        $response = $this->client->request('GET', 'api/numbers/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals('Prologue', $arrayResponse['title']);
        $this->assertEquals('virtual audience imagined by the performers', $arrayResponse['spectators'][0]['title']);
        $this->assertEquals('Fred Astaire', $arrayResponse['performers'][0]['fullname']);
    }

    public function testGetNotFoundNumber()
    {
        $uuid = '42187cb9-f1f3-4a22-807d-a8c59b6b5f5b'; // false uuid corresponding to any number
        $response = $this->client->request('GET', 'api/numbers/'.$uuid);
        $this->assertResponseStatusCodeSame(404);

    }
}