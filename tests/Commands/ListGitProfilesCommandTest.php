<?php

namespace Tests\Commands;

use Zeeshan\GitProfile\Commands\ListGitProfilesCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

class ListGitProfilesCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var ListGitProfilesCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new ListGitProfilesCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
    }

    public function testListGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([]);

        $this->assertContains('Available profiles', $commandTester->getDisplay());
        $this->assertContains('test-Personal', $commandTester->getDisplay());
    }
}
