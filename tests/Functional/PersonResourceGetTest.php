<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PersonResourceGetTest extends AbstractFunctionalTest
{
    public function testGetPerson()
    {
        self::generateStats();

        $uuid = 'a092dcb7-e7c4-4b20-b0a4-c1481b97022c';
        $response = $this->client->request('GET', 'api/people/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals('Fred Astaire', $arrayResponse['fullname']);
        $this->assertEquals('M', $arrayResponse['gender']);
        $this->assertEquals('person', $arrayResponse['type']);
    }

    public function testGetGroup()
    {
        $uuid = '44b995b2-a734-447b-9297-a9e8fb7fa542';
        $response = $this->client->request('GET', 'api/people/'.$uuid);
        $this->assertResponseIsSuccessful();

        $arrayResponse = $response->toArray();
        $this->assertEquals('Sharks', $arrayResponse['fullname']);
        $this->assertEquals('group', $arrayResponse['type']);
    }

    public function testGetNotFoundPerson()
    {
        $uuid = '42187cb9-f1f3-4a22-807d-a8c59b6b5f5b'; // false uuid corresponding to any number
        $response = $this->client->request('GET', 'api/people/'.$uuid);
        $this->assertResponseStatusCodeSame(404);

    }

    protected function generateStats()
    {
        // cf Symfony doc on how to test commands = https://symfony.com/doc/current/console.html#testing-commands
        $kernel = self::createKernel();
        $application = new Application($kernel);

        $command = $application->find('stats:person:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);
    }

}