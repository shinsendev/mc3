<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

abstract class AbstractFunctionalTest extends ApiTestCase
{
    use FixturesTrait;

    /** @var \ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client  */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->loadFixtures([
            'App\DataFixtures\SongFixtures',
        ]);
    }
}