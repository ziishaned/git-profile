<?php 

namespace Tests\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\BaseCommand;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;

class BaseCommandTest extends \PHPUnit_Framework_TestCase
{
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

   public function testSwitchProfileMustEqualsToReteriveProfileForGlobalFlag()
   {
      $flag = 'global';
      $profileTitle = 'Personal';

      $this->command->switchProfile($profileTitle, $flag);
      $reterivedProfile = $this->command->reteriveCurrentProfile($flag);

      $this->assertTrue($profileTitle == $reterivedProfile);
   }

   public function testSwitchProfileMustEqualsToReteriveProfileForNoGlobalFlag()
   {
      $profileTitle = 'Personal';

      $this->command->switchProfile($profileTitle);
      $reterivedProfile = $this->command->reteriveCurrentProfile();

      $this->assertTrue($profileTitle == $reterivedProfile);
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