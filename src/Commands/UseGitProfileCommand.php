<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class UseGitProfileCommand extends BaseCommand
{
	/**
	 * Configure the command
	 * 
	 * @return void
	 */
	public function configure()
	{
		$this->setName('use')
			 ->setDescription('Change git profile locally or globally.')	
			 ->addArgument('profile-title', InputArgument::REQUIRED, 'Git progile title.')
			 ->addOption('global', null, InputOption::VALUE_NONE, 'Set git profile global.');	
	}

	/**
	 * Execute the command
	 * 
	 * @param  Symfony\Component\Console\Input\InputInterface  $input  
	 * @param  Symfony\Component\Console\Output\OutputInterface $output 
	 * @return void                  
	 */
	public function execute(InputInterface $input, OutputInterface $output)
	{ 
		$profileTitle = $input->getArgument('profile-title');

		$useremail = $this->runCommand(sprintf('git config --global profile.%s.email', $profileTitle));
		$username = $this->runCommand(sprintf('git config --global profile.%s.name', $profileTitle));

		$mustRun = true;
		$this->runCommand(sprintf('git config --global user.name "%s"', $username), $mustRun);
		$this->runCommand(sprintf('git config --global user.email "%s"', $useremail), $mustRun);

		$output->writeln('Git profile successfully changed.');
	}
}