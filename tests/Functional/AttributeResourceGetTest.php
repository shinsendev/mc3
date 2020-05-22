<?php

declare(strict_types=1);

namespace App\Tests\Functional;

class AttributeResourceGetTest extends AbstractFunctionalTest
{
    public function testGetAttribute()
    {
        $uuid = '6c2bc54f-6d47-4638-adc0-7692803065d6';
        $response = $this->client->request('GET', 'api/attributes/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals($arrayResponse["title"], "savage");
        $this->assertEquals($arrayResponse["categoryTitle"], "Exoticism");
        $this->assertEquals($arrayResponse["categoryUuid"], "d720cdfc-ab15-4363-8d56-e9a1ae2fe9e7");
        $this->assertEquals($arrayResponse["description"], "Any type of number involving savage and wild dances but without a specific location (could be African, Haitian...)");
        $this->assertEquals($arrayResponse["example"], "\"Monkey Doodle-Doo\" in The Cocoanuts");
    }
}