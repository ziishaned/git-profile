<?php

namespace Tests;

use Symfony\Component\Console\Application;
use Symfony\Component\Process\Process;
use Zeeshan\GitProfile\GitProfile;

class GitProfileTest extends \PHPUnit_Framework_TestCase
{
    private $app;

    protected function setUp()
    {
        $this->app = new Application('test', false);
        $this->app->setAutoExit(false);
    }

    public function testGetCommandsShouldReturnArray()
    {
        $gitprofile = new GitProfile();
        $this->assertNotEmpty($gitprofile->getCommands());
    }

    public function testCanRunProfileBaseCommand()
    {
        $process = new Process('php bin/git-profile');
        $process->run();

        $this->assertSame(0, $process->getExitCode());
    }
}
