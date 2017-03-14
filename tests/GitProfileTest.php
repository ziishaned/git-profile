<?php

namespace Tests;

use Zeeshan\GitProfile\GitProfile;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;

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

        $this->assertEquals(0, $process->getExitCode());
    }
}
