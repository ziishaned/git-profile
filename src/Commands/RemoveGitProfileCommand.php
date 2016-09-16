<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class RemoveGitProfileCommand extends BaseCommand
{
	public function configure()
	{
		$this->setName('rm')
			 ->setDescription('Remove git profile.')
			 ->addArgument('profile-title', InputArgument::REQUIRED, 'Your profile title e.g personal or office');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$profileTitle = $input->getArgument('profile-title');

		if($this->doesProfileExists($profileTitle)) {
			$this->removeProfile($profileTitle);
			$output->writeln('Git profile ' . $profileTitle . ' successfully removed.');
			exit(1);
		};
		
		$output->writeln('Git profile ' . $profileTitle . ' not exists.');

	}

	public function removeProfile($profileTitle)
	{
		$mustRun = true;
		$this->runCommand(sprintf('git config --global --remove-section profile."%s"', $profileTitle), $mustRun);

		return true;
	}

	public function doesProfileExists($profileTitle)
	{
		$commandOutput = $this->runCommand('git config -l --name-only');

		if (stripos($commandOutput, "profile." . $profileTitle)) {
			return true;
		}		
		
		return false;
	}
}