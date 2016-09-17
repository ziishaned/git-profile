<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class UpdateGitProfileCommand extends BaseCommand
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
		$this->setName('update')
			 ->setDescription('Update git profile.');
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
		$style = new SymfonyStyle($input, $output);

		$output->writeln('');
		
		$profileTitle =  $this->askQuestion("[+] Enter profile Title: ", true, 'Profile Title is required.');
		if(!$this->doesProfileExists($profileTitle)) {
			$style->error('Profile "' . $profileTitle . '" not exists.');
			exit(1);
		}

		$output->writeln('');
		$username 	 =  $this->askQuestion("[+] Enter Name: ", true, 'Name is required.');
		$useremail 	 =  $this->askQuestion("[+] Enter Email: ", true, 'Email is required.');
		$output->writeln('');

		if ($this->updateProfile($profileTitle, $username, $useremail)) {
			$style->success('Profile "' . $profileTitle . '" updated successfuly');
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
		$style = new SymfonyStyle($this->input, $this->output);

		$question->setValidator(function ($value) use ($output, $message, $style) {
	        
	        if (empty($value)) {
	        	$style->error($message);
	        	exit(1);
	        }

	        return $value;
	    });

	    return $helper->ask($this->input, $this->output, $question);
	}

	/**
	 * Update git profile
	 * 
	 * @param  string $profileTitle
	 * @param  string $username
	 * @param  string $useremail
	 * @return boolean
	 */
	public function updateProfile($profileTitle, $username, $useremail)
	{
		$mustRun = true;
		$this->runCommand(sprintf('git config --global profile."%s".name "%s"', $profileTitle, $username), $mustRun);
		$this->runCommand(sprintf('git config --global profile."%s".email "%s"', $profileTitle, $useremail), $mustRun);

		return true;
	}
}