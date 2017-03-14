<?php

namespace Tests\Commands;

use Zeeshan\GitProfile\Commands\UpdateGitProfileCommand;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Console\Application;

class UpdateGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var UpdateGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new UpdateGitProfileCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
    }

    public function testUpdateGitProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->setInputs(['test-Personal', 'Zeeshan Ahmed2', 'ziishaned2@gmail.com', 'XXXXXXXX']);
        $commandTester->execute([]);

        $this->assertContains('Profile "test-Personal" updated successfuly', $commandTester->getDisplay());
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Profile "unknown" not exists
     */
    public function testUpdateGitProfileUnknownProfile()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->setInputs(['unknown']);
        $commandTester->execute([]);
    }
}
