<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zeeshan\GitProfile\GitProfile;

class GitProfileCommand extends BaseCommand
{
	public function configure()
	{
		$this->setName('gitprofile')
			 ->setDescription('Change git profile on the go.');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln(GitProfile::APPLICATION_NAME . ' version ' . GitProfile::APPLICATION_VERSION);
		$output->writeln('');
		$output->writeln('usage:');
		$output->writeln('  git profile [options] <command>');
		$output->writeln('');
		$output->writeln('Commands:');
		$output->writeln('  rm               Remove git profile');
		$output->writeln('  add              Create a new git profile');
		// $output->writeln('  list             Display all git profiles');
		$output->writeln('  use              Change git profile locally or globally');
		$output->writeln('');
		$output->writeln('Options:');
		$output->writeln('  -h, --help       Display this help message');
		$output->writeln('  -V, --version    Display this application version');
		$output->writeln('');
	}	
}