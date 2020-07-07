<?php

namespace App\Tests\Command;

use App\Tests\Functional\AbstractFunctionalTest;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;


class PeopleStatsTest extends AbstractFunctionalTest
{
    public function testGeneratePeopleStats()
    {
        // cf Symfony doc on how to test commands = https://symfony.com/doc/current/console.html#testing-commands
        $kernel = self::createKernel();
        $application = new Application($kernel);

        $command = $application->find('stats:person:update');
        $commandTester = new CommandTester($command);
        $commandTester->execute([]);

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('[OK] All persons stats have been updated', $output);
    }
}
