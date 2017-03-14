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
class RemoveGitProfileCommand extends BaseCommand
{
    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('rm')
            ->setDescription('Remove git profile.')
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

        if ($this->doesProfileExists($profileTitle) && $this->removeProfile($profileTitle)) {
            $style->success('Profile "' . $profileTitle . '" successfully removed.');

            return;
        }

        throw new \Exception('Profile "' . $profileTitle . '" not exists.');
    }

    /**
     * Remove git profile.
     *
     * @param string $profileTitle
     *
     * @return bool
     */
    public function removeProfile($profileTitle)
    {
        $mustRun = true;
        $this->runCommand(sprintf('git config --global --remove-section profile."%s"', $profileTitle), $mustRun);

        return true;
    }
}
