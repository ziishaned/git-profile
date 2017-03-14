<?php

namespace Tests\Commands;

use Zeeshan\GitProfile\Commands\GitProfileCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

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
