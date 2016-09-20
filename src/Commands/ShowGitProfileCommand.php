<?php

namespace Zeeshan\GitProfile\Commands;

use Zeeshan\GitProfile\Commands\BaseCommand;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class ShowGitProfileCommand extends BaseCommand
{

    /**
     * Configure the command
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('show')
             ->setDescription('Get the profile detail.')
             ->addArgument('profile-title', InputArgument::REQUIRED, 'Your profile title e.g personal or office');
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
        $profileTitle = $input->getArgument('profile-title');

        if ($this->doesProfileExists($profileTitle)) {
            $profileInfo = $this->getProfile($profileTitle);

            $output->writeln('');
            $output->writeln('[+] Name: ' . $profileInfo['name']);
            $output->writeln('[+] Email: ' . $profileInfo['email']);
            exit(1);
        };

        $style->error('Profile "' . $profileTitle . '" not exists.');
    }

    /**
     * Get profile detail
     *
     * @param  string $profileTitle
     * @return boolean
     */
    public function getProfile($profileTitle)
    {
        $mustRun = true;
        $profileInfo = [];

        $profileInfo['name'] = $this->runCommand(
            sprintf('git config --global profile."%s".name', $profileTitle),
            $mustRun
        );

        $profileInfo['email'] = $this->runCommand(
            sprintf('git config --global profile."%s".email', $profileTitle),
            $mustRun
        );

        return $profileInfo;
    }
}
