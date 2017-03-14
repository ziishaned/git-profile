<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\GitProfileCommand;

class GitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var GitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new GitProfileCommand();
        $this->command->setApplication($application);
    }

    public function testGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([]);

        $this->assertContains('git profile [options] <command>', $commandTester->getDisplay());
    }
}
