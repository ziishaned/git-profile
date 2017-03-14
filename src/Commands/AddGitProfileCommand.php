<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class AddGitProfileCommand extends BaseCommand
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('add')
            ->setDescription('Create new git profile.');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $style = new SymfonyStyle($input, $output);

        $output->writeln('');
        $profileTitle = $this->askQuestion('[+] Enter profile Title: ', 'Profile Title is required.');

        $output->writeln('');
        $username = $this->askQuestion('[+] Enter Name: ', 'Name is required.');
        $email = $this->askQuestion('[+] Enter Email: ', 'Email is required.');
        $signingkey = $this->askQuestion('[+] Enter Signingkey: ', 'Signingkey is optional.', false);

        $output->writeln('');

        if ($this->saveProfile($profileTitle, $username, $email, $signingkey)) {
            $style->success('Profile "' . $profileTitle . '" saved successfuly');
        }
    }
}
