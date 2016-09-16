<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Question\Question;

class AddGitProfileCommand extends BaseCommand
{

	protected $input;
	protected $output;

	public function configure()
	{
		$this->setName('add')
			 ->setDescription('Create new git profile.');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$this->input  =  $input;
		$this->output =  $output;

		$profileTitle =  $this->askQuestion("[+] Enter profile title: ", true, 'Git profile name is required.');
		$output->writeln('');
		$username 	 =  $this->askQuestion("[+] Enter git user.name: ", true, 'Git user.name is required.');
		$useremail 	 =  $this->askQuestion("[+] Enter git user.email: ", true, 'Git user.email is required.');


		if ($this->saveProfile($profileTitle, $username, $useremail)) {
			$output->writeln('');
			$output->writeln('<info>Git profile ' . $profileTitle . ' successfully saved.</info>');
		}
	}

	public function askQuestion($question, $required = false, $message)
	{
		$helper = $this->getHelper('question');
		$output = $this->output;

		$question = new Question($question);
		$question->setValidator(function ($value) use ($output, $message) {
	        
	        if (empty($value)) {
	        	$output->write('<info>' . $message . '</info>');
	        	exit(1);
	        }

	        return $value;
	    });

	    return $helper->ask($this->input, $this->output, $question);
	}

	public function saveProfile($profileTitle, $username, $useremail)
	{
		$mustRun = true;
		$this->runCommand(sprintf('git config --global profile."%s".name "%s"', $profileTitle, $username), $mustRun);
		$this->runCommand(sprintf('git config --global profile."%s".email "%s"', $profileTitle, $useremail), $mustRun);

		return true;
	}
}