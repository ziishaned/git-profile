<?php 

namespace Tests\Commands;

use Zeeshan\GitProfile\GitProfile;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;

class RemoveGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
	private $command;

	protected function setUp()
    {
        $this->command = new RemoveGitProfileCommand();
    }

    public function testRemoveProfileShouldRemoveGitProfile()
    {
    	$result = $this->command->removeProfile('Personal');
    	$this->assertTrue($result);
    }
}