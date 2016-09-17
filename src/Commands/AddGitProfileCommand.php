<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class AddGitProfileCommand extends BaseCommand
{

	/**
	 * @var Symfony\Component\Console\Input\InputInterface
	 */
	protected $input;

	/**
	 * @var Symfony\Component\Console\Output\OutputInterface
	 */
	protected $output;

	/**
	 * Configure the command
	 * 
	 * @return void
	 */
	public function configure()
	{
		$this->setName('add')
			 ->setDescription('Create new git profile.');
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

	/**
	 * On CLI ask quesion to user.
	 * 
	 * @param  string  $question
	 * @param  boolean $required
	 * @param  string  $message
	 * @return mixed
	 */
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

	/**
	 * Save git profile
	 * 
	 * @param  string $profileTitle
	 * @param  string $username
	 * @param  string $useremail
	 * @return boolean
	 */
	public function saveProfile($profileTitle, $username, $useremail)
	{
		$mustRun = true;
		$this->runCommand(sprintf('git config --global profile."%s".name "%s"', $profileTitle, $username), $mustRun);
		$this->runCommand(sprintf('git config --global profile."%s".email "%s"', $profileTitle, $useremail), $mustRun);

		return true;
	}
}