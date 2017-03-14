<?php

namespace Zeeshan\GitProfile;

use Symfony\Component\Console\Application;
use Zeeshan\GitProfile\Commands\AddGitProfileCommand;
use Zeeshan\GitProfile\Commands\CurrentGitProfileCommand;
use Zeeshan\GitProfile\Commands\GitProfileCommand;
use Zeeshan\GitProfile\Commands\ListGitProfilesCommand;
use Zeeshan\GitProfile\Commands\RemoveGitProfileCommand;
use Zeeshan\GitProfile\Commands\ShowGitProfileCommand;
use Zeeshan\GitProfile\Commands\UpdateGitProfileCommand;
use Zeeshan\GitProfile\Commands\UseGitProfileCommand;

/**
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class GitProfile
{
    /**
     * @var string
     */
    const APPLICATION_NAME = 'Git Profile';

    /**
     * @var string
     */
    const APPLICATION_VERSION = '2.0';

    /**
     * @var array
     */
    protected $commands = [];

    public function __construct()
    {
        $this->commands[] = new GitProfileCommand();
        $this->commands[] = new AddGitProfileCommand();
        $this->commands[] = new UseGitProfileCommand();
        $this->commands[] = new RemoveGitProfileCommand();
        $this->commands[] = new ShowGitProfileCommand();
        $this->commands[] = new UpdateGitProfileCommand();
        $this->commands[] = new CurrentGitProfileCommand();
        $this->commands[] = new ListGitProfilesCommand();
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
     */
    public function runApplication()
    {
        $application = new Application(self::APPLICATION_NAME, self::APPLICATION_VERSION);
        $application->setDefaultCommand('gitprofile');
        $application->addCommands($this->getCommands());
        $application->run();
    }
}
