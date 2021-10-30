<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;

abstract class AbstractFunctionalTest extends ApiTestCase
{
    use FixturesTrait;

    /** @var Client */
    protected Client $client;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        self::generateStats();
        $this->loadFixtures([
            'App\DataFixtures\PersonFixtures',
            'App\DataFixtures\CategoryFixtures',
            'App\DataFixtures\AttributeFixtures',
            'App\DataFixtures\SongFixtures',
            'App\DataFixtures\FilmFixtures',
            'App\DataFixtures\NumberFixtures',
        ]);
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