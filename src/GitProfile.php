<?php 

namespace Zeeshan\GitProfile;

use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\GitProfileCommand;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;
use Zeeshan\GitProfile\Commands\UseGitProfileCommand;
use Zeeshan\GitProfile\Commands\ShowGitProfileCommand;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;
use Zeeshan\GitProfile\Commands\UpdateGitProfileCommand;
// use Zeeshan\GitProfile\Commands\ListGitProfilesCommand;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class GitProfile
{

	/**
	 * @var array
	 */
	protected $commands = [];
	
	/**
	 * @var string
	 */
	CONST APPLICATION_NAME = 'Git Profile';
	
	/**
	 * @var  string
	 */
	CONST APPLICATION_VERSION = '1.0';

	public function __construct()
	{
		$this->commands[] = new GitProfileCommand();
		$this->commands[] = new AddGitProfileCommand();
		$this->commands[] = new UseGitProfileCommand();
		$this->commands[] = new RemoveGitProfileCommand();
		$this->commands[] = new ShowGitProfileCommand();
		$this->commands[] = new UpdateGitProfileCommand();
		// $this->commands[] = new ListGitProfilesCommand();
	}

	/**
	 * @return array
	 */
	public function getCommands()
	{
		return $this->commands;
	}

	/**
	 * The function from where whole fun begins.
	 * 
	 * @return void
	 */
	public function runApplication()
	{
		$application = new Application(self::APPLICATION_NAME, self::APPLICATION_VERSION);
		$application->setDefaultCommand('gitprofile');
		$application->addCommands($this->getCommands());

		$application->run();
	}
}