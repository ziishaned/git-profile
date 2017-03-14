<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class ShowGitProfileCommand extends BaseCommand
{
    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('show')
            ->setDescription('Get the profile detail.')
            ->addArgument('profile-title', InputArgument::REQUIRED, 'Your profile title e.g personal or office');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
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
            $output->writeln('[+] Signingkey: ' . $profileInfo['signingkey']);

            return;
        }

        throw new \Exception('Profile "' . $profileTitle . '" not exists.');
    }

    /**
     * Get profile detail.
     *
     * @param string $profileTitle
     *
     * @return array
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

        $profileInfo['signingkey'] = $this->runCommand(
            sprintf('git config --global profile."%s".signingkey', $profileTitle),
            false
        );

        return $profileInfo;
    }
}
