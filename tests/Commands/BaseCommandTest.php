<?php 

namespace Tests\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\BaseCommand;

class BaseCommandTest extends \PHPUnit_Framework_TestCase
{
	private $command;

	public function setUp()
	{
		$this->command = new BaseCommand('optional-arg'); 
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
}