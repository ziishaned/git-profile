<?php 

namespace Zeeshan\GitProfile;

use Symfony\Component\Console\Application;
// use Zeeshan\GitProfile\Commands\ListGitProfilesCommand;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;
use Zeeshan\GitProfile\Commands\GitProfileCommand;
use Zeeshan\GitProfile\Commands\UseGitProfileCommand;

class GitProfile
{
	protected $commands = [];
	
	CONST APPLICATION_NAME = 'Git Profile';
	
	CONST APPLICATION_VERSION = '1.0';

	public function __construct()
	{
		$this->commands[] = new GitProfileCommand();
		// $this->commands[] = new ListGitProfilesCommand();
		$this->commands[] = new AddGitProfileCommand();
		$this->commands[] = new RemoveGitProfileCommand();
		$this->commands[] = new UseGitProfileCommand();
	}

	public function getCommands()
	{
		return $this->commands;
	}

	public function runApplication()
	{
		$application = new Application(self::APPLICATION_NAME, self::APPLICATION_VERSION);
		$application->setDefaultCommand('gitprofile');
		$application->addCommands($this->getCommands());

		$application->run();
	}
}