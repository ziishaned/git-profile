<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zeeshan\GitProfile\GitProfile;

/**
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class GitProfileCommand extends BaseCommand
{
    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('gitprofile')
            ->setDescription('Change git profile on the go.');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('');
        $output->writeln(
            GitProfile::APPLICATION_NAME . ' version ' . GitProfile::APPLICATION_VERSION . ' by Zeeshan Ahmed'
        );
        $output->writeln('');
        $output->writeln('usage:');
        $output->writeln('  git profile [options] <command>');
        $output->writeln('');
        $output->writeln('Options');
        $output->writeln('  -h, --help              Display this help message');
        $output->writeln('  -V, --version           Display this application version');
        $output->writeln('  --ansi                  Force ANSI output');
        $output->writeln('  --no-ansi               Disable ANSI output');
        $output->writeln('');
        $output->writeln('Available commands:');
        $output->writeln('  rm                     Remove git profile');
        $output->writeln('  use                    Change git profile locally or globally');
        $output->writeln('  add                    Create a new git profile');
        $output->writeln('  show                   Get the profile detail');
        $output->writeln('  update                 Update git profile');
        $output->writeln('  current                Get the current profile');
        $output->writeln('  list                   List of profiles');
        $output->writeln('');
    }
}
