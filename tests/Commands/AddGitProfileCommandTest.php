<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;

class AddGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var AddGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new AddGitProfileCommand();
        $this->command->setApplication($application);
    }

    public function testAddGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->setInputs(['test-Office', 'John Doe', 'john@google.io', 'XXXXXXXX']);
        $commandTester->execute([]);

        $this->assertContains('Profile "test-Office" saved successfuly', $commandTester->getDisplay());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Email is required
     */
    public function testAddGitProfileWithoutRequiredValue()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->setInputs(['test-Office', 'John Doe', '', 'XXXXXXXX']);
        $commandTester->execute([]);
    }
}
