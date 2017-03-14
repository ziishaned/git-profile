<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @package   Git Profile
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
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
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $mustRun = true;
        $style = new SymfonyStyle($input, $output);
        $profileTitle = $input->getArgument('profile-title');

        if (!$this->doesProfileExists($profileTitle)) {
            throw new \Exception('Profile "' . $profileTitle . '" not exists.');
        }

        $name  = $this->runCommand(sprintf('git config --global profile.%s.name', $profileTitle));
        $email  = $this->runCommand(sprintf('git config --global profile.%s.email', $profileTitle));
        $signingkey = $this->runCommand(sprintf('git config --global profile.%s.signingkey', $profileTitle));

        if ($input->getOption('global')) {
            $this->runCommand(sprintf('git config --global user.name "%s"', $name), $mustRun);
            $this->runCommand(sprintf('git config --global user.email "%s"', $email), $mustRun);
            $this->runCommand(sprintf('git config --global user.signingkey "%s"', $signingkey), $mustRun);

            $this->switchProfile($profileTitle, 'global');

            $output->writeln('');
            $style->success('Switched to "' . $profileTitle . '" *globally*');

            return;
        }

        $this->runCommand(sprintf('git config user.name "%s"', $name), $mustRun);
        $this->runCommand(sprintf('git config user.email "%s"', $email), $mustRun);
        $this->runCommand(sprintf('git config user.signingkey "%s"', $signingkey), $mustRun);

        $this->switchProfile($profileTitle);

        $output->writeln('');
        $style->success('Switched to "' . $profileTitle . '"');
    }
}
