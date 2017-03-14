<?php

namespace Tests\Commands;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;

class RemoveGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var RemoveGitProfileCommand */
    private $command;

    protected function setUp()
    {
        $application = new Application();
        $application->setAutoExit(false);

        $this->command = new RemoveGitProfileCommand();
        $this->command->setApplication($application);
        $this->command->saveProfile('test-Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com', 'B7789A12');
    }

    public function testRemoveProfileShouldRemoveGitProfile()
    {
        $result = $this->command->removeProfile('test-Personal');
        $this->assertTrue($result);
    }

    public function testDoesProfileExistsMustReturnFalseIfProfileNotExists()
    {
        $result = $this->command->doesProfileExists('xyz');
        $this->assertFalse($result);
    }

    public function testDoesProfileExistsMustReturnTrueIfProfileExists()
    {
        $result = $this->command->doesProfileExists('test-Personal');
        $this->assertTrue($result);
    }

    public function testRemoveGitProfileCommand()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'test-Personal',
        ]);

        $this->assertContains('Profile "test-Personal" successfully removed', $commandTester->getDisplay());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Profile "unknown" not exists
     */
    public function testRemoveGitProfileCommandUnknown()
    {
        $commandTester = new CommandTester($this->command);
        $commandTester->execute([
            'profile-title' => 'unknown',
        ]);
    }
}
