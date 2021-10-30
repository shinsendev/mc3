<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;

abstract class AbstractFunctionalTest extends ApiTestCase
{
    /** @var Client */
    protected Client $client;

    /**
     * @var AbstractDatabaseTool
     */
    protected AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        self::generateStats();
        $container = static::getContainer();
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadFixtures([
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