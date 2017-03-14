<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\UseGitProfileCommand;

class UseGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var UseGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new UseGitProfileCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
        $this->command->saveProfile('test-Office', 'John Doe', 'john@google.io');
    }

    public function testUseGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'test-Personal',
        ]);

        $this->assertContains('Switched to "test-Personal"', $commandTester->getDisplay());
    }

    public function testUseGitProfileGlobal()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'test-Office',
            '--global' => true,
        ]);

        $this->assertContains('Switched to "test-Office" *globally*', $commandTester->getDisplay());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Profile "unknown" not exists
     */
    public function testUseGitProfileUnknownProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'unknown',
        ]);
    }
}
