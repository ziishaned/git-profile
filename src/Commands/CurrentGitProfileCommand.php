<?php 

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class CurrentGitProfileCommand extends BaseCommand
{

    /**
     * Configure the command
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('current')
             ->setDescription('Get the current profile.')
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

        $style = new SymfonyStyle($input, $output);

        if ($input->getOption('global')) {
            $currentProfile = $this->reteriveCurrentProfile('global');
        }

        $currentProfile = $this->reteriveCurrentProfile();

        if ($this->doesProfileExists($currentProfile)) {
            $email =  $this->runCommand(sprintf('git config --global profile.%s.email', $currentProfile));
            $name  =  $this->runCommand(sprintf('git config --global profile.%s.name', $currentProfile));

            $output->writeln('');
            $output->writeln('[+] Current Profile: ' . $currentProfile);
            $output->writeln('[+] Name: ' . $name);
            $output->writeln('[+] Email: ' . $email);
            exit(1);
        }

        $style->error('Something went wrong.');
    }
}