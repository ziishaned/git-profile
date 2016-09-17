<?php 

namespace Tests\Commands;

use Zeeshan\GitProfile\GitProfile;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;

class AddGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
	private $command;

	protected function setUp()
    {
        $this->command = new AddGitProfileCommand();
    }

    public function testSaveProfileShouldSaveGitProfile()
    {
    	$result = $this->command->saveProfile('Personal', 'Zeeshan Ahmed', 'ziishaned@gmail.com');
    	$this->assertTrue($result);
    }
}