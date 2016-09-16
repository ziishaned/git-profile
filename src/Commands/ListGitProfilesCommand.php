<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListGitProfilesCommand extends BaseCommand
{
	public function configure()
	{
		$this->setName('list')
			 ->setDescription('Get all the git profiles.');	
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('This is your <info>.gitconfig</info> from your PC Home directory.');
		$output->writeln(file_get_contents($_SERVER['HOMEPATH'] . '\.gitconfig'));
	}
}