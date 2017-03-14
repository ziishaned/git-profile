<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\CurrentGitProfileCommand;
use Zeeshan\GitProfile\Commands\UseGitProfileCommand;

class CurrentGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var CurrentGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new CurrentGitProfileCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
        $this->command->saveProfile('test-Office', 'John Doe', 'john@google.io');
    }

    public function testCurrentGitProfile()
    {
        $useCommand = new UseGitProfileCommand();
        $commandTester = new CommandTester($useCommand);
        $commandTester->execute([
            'profile-title' => 'test-Personal',
        ]);

        $commandTester = new CommandTester($this->command);
        $commandTester->execute([]);

        $this->assertContains('Current Profile: test-Personal', $commandTester->getDisplay());
        $this->assertContains('Name: Zeeshan Ahmed', $commandTester->getDisplay());
        $this->assertContains('Email: ziishaned@gmail.com', $commandTester->getDisplay());
        $this->assertContains('Signingkey: B7789A12', $commandTester->getDisplay());
    }

    public function testCurrentGitProfileGlobal()
    {
        $useCommand = new UseGitProfileCommand();
        $commandTester = new CommandTester($useCommand);
        $commandTester->execute([
            'profile-title' => 'test-Office',
            '--global' => true,
        ]);

        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            '--global' => true,
        ]);

        $this->assertContains('Current Profile: test-Office', $commandTester->getDisplay());
        $this->assertContains('Name: John Doe', $commandTester->getDisplay());
        $this->assertContains('Email: john@google.io', $commandTester->getDisplay());
        $this->assertContains('Signingkey: ', $commandTester->getDisplay());
    }

    public function testCurrentGitProfileNotSet()
    {
        // cleanup all tests profile
        $this->command->runCommand('git config --global --remove-section profile."test-Office"', true);
        $this->command->runCommand('git config --global --remove-section profile."test-Personal"', true);

        $commandTester = new CommandTester($this->command);
        $commandTester->execute([]);

        $this->assertContains('Profile is not set. Standard settings are used.', $commandTester->getDisplay());
    }
}
