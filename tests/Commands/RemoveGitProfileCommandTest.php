<?php 

namespace Tests\Commands;

use Zeeshan\GitProfile\GitProfile;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Application;

class RemoveGitProfileCommandTest extends \PHPUnit_Framework_TestCase
{
	private $app;

	protected function setUp()
    {
        $this->app = new Application('test', false);
        $this->app->setAutoExit(false);
    }
}