<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\ShowGitProfileCommand;

class ShowGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var ShowGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new ShowGitProfileCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
    }

    public function testShowGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'test-Personal',
        ]);

        $this->assertContains('Name: Zeeshan Ahmed', $commandTester->getDisplay());
        $this->assertContains('Email: ziishaned@gmail.com', $commandTester->getDisplay());
        $this->assertContains('Signingkey: B7789A12', $commandTester->getDisplay());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Profile "unknown" not exists
     */
    public function testShowGitProfileUnknown()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'unknown',
        ]);
    }
}
