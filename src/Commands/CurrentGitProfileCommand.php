<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class CurrentGitProfileCommand extends BaseCommand
{
    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('current')
            ->setDescription('Get the current profile.')
            ->addOption('global', null, InputOption::VALUE_NONE, 'Set git profile global.');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('global')) {
            $currentProfile = $this->retrieveCurrentProfile(true);
        } else {
            $currentProfile = $this->retrieveCurrentProfile();
        }

        if (!empty($currentProfile) && $this->doesProfileExists($currentProfile)) {
            $email = $this->runCommand(sprintf('git config --global profile.%s.email', $currentProfile));
            $name = $this->runCommand(sprintf('git config --global profile.%s.name', $currentProfile));
            $signingkey = $this->runCommand(sprintf('git config --global profile.%s.signingkey', $currentProfile));

            $output->writeln('');
            $output->writeln('[+] Current Profile: ' . $currentProfile);
            $output->writeln('[+] Name: ' . $name);
            $output->writeln('[+] Email: ' . $email);
            $output->writeln('[+] Signingkey: ' . $signingkey);

            return;
        }

        $output->writeln('');
        $output->writeln('[+] Profile is not set. Standard settings are used.');
        $output->writeln(sprintf('[+] Name: %s', $this->runCommand(sprintf('git config user.name'))));
        $output->writeln(sprintf('[+] Email: %s', $this->runCommand(sprintf('git config user.email'))));
        $output->writeln(sprintf('[+] Signingkey: %s', $this->runCommand(sprintf('git config user.signingkey'))));
    }
}
