<?php

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @package   Git Profile
 * @author    Zeeshan Ahmed <ziishaned@gmail.com>
 * @copyright 2016 Zeeshan Ahmed
 * @license   http://www.opensource.org/licenses/mit-license.html MIT License
 */
class ListGitProfilesCommand extends BaseCommand
{

    /**
     * Configure the command
     *
     * @return void
     */
    public function configure()
    {
        $this->setName('list')
            ->setDescription('Get all the git profiles.');
    }

    /**
     * Execute the command
     *
     * @param  InputInterface $input
     * @param  OutputInterface $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $style = new SymfonyStyle($input, $output);

        // don't know how it will be works on other systems
        // mb add while and check several paths?
        $configPath = sprintf('%s%s.gitconfig', $_SERVER['HOME'], DIRECTORY_SEPARATOR);

        if (file_exists($configPath)) {
            $config = file_get_contents($configPath);

            if (preg_match_all('~\[profile "(.*?)"\]~ui', $config, $found)) {
                $profiles = array_unique($found[1]);

                $output->writeln('');
                $output->writeln('Available profiles:');

                array_walk($profiles, function ($v) use ($output) {
                    $output->writeln(sprintf('    %s', $v));
                });
                exit();
            }

            $style->error("Profiles not setted.");
            exit();
        }

        $style->error("Can't detect .gitconfig file");
    }
}
