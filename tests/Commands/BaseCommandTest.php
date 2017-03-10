<?php

namespace Tests\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;

class BaseCommandTest extends \PHPUnit_Framework_TestCase
{
    /** @var  BaseCommand */
    private $command;

    public function setUp()
    {
        $this->command = new BaseCommand('optional-arg');
        (new AddGitProfileCommand)->saveProfile('Personal', 'John Doe', 'johndoe@gmail.com');
    }

    public function testMustRunCommandReturnsOutputForValidCommand()
    {
        $mustRun = true;
        $expectedOutput = 'test output';

        $result = $this->command->runCommand(sprintf('echo %s', $expectedOutput), $mustRun);
        $this->assertEquals($expectedOutput, $result);
    }

    /**
     * @expectedException \Exception
     */
    public function testMustRunCommandFailsForInvalidCommand()
    {
        $mustRun = true;

        $this->command->runCommand('Invalid Command', $mustRun);
    }

    public function testSwitchProfileGlobalIfFlagIsGlobal()
    {
        $flag = 'global';

        $result = $this->command->switchProfile('Personal', $flag);
        $this->assertTrue($result);
    }

    public function testSwitchProfileLocalIfFlagIsNotSet()
    {
        $result = $this->command->switchProfile('Personal');
        $this->assertTrue($result);
    }

    public function testSwitchProfileMustEqualsToRetrieveProfileForGlobalFlag()
    {
        $flag = 'global';
        $profileTitle = 'Personal';

        $this->command->switchProfile($profileTitle, $flag);
        $retrievedProfile = $this->command->retrieveCurrentProfile($flag);

        $this->assertTrue($profileTitle == $retrievedProfile);
    }

    public function testSwitchProfileMustEqualsToRetrieveProfileForNoGlobalFlag()
    {
        $profileTitle = 'Personal';

        $this->command->switchProfile($profileTitle);
        $retrievedProfile = $this->command->retrieveCurrentProfile();

        $this->assertTrue($profileTitle == $retrievedProfile);
    }

    public function testDoesProfileExistsShouldReturnsTrueIfProfileExists()
    {
        $this->setUp();
        $result = $this->command->doesProfileExists('Personal');

        $this->assertTrue($result);
    }

    public function testDoesProfileExistsShouldReturnsFalseIfProfileNotExists()
    {
        $result = $this->command->doesProfileExists('Not Exist');

        $this->assertFalse($result);
    }
}