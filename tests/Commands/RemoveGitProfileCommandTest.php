<?php 

namespace Tests\Commands;

use Zeeshan\GitProfile\GitProfile;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;

class RemoveGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
	private $command;

	protected function setUp()
    {
        $this->command = new RemoveGitProfileCommand();
    	(new AddGitProfileCommand)->saveProfile('Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com');
    }

    public function testRemoveProfileShouldRemoveGitProfile()
    {
    	$result = $this->command->removeProfile('Personal');
    	$this->assertTrue($result);
    }

    public function testDoesProfileExistsMustReturnFalseIfProfileNotExists()
    {
    	$result = $this->command->doesProfileExists('xyz');
    	$this->assertFalse($result);
    }

    public function testDoesProfileExistsMustReturnTrueIfProfileExists()
    {
    	$this->setUp();
    	$result = $this->command->doesProfileExists('Personal');
    	$this->assertTrue($result);
    }
}