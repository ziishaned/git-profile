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
class ListGitProfilesCommand extends BaseCommand
{
    /**
     * Configure the command.
     */
    public function configure()
    {
        $this->setName('list')
            ->setDescription('Get all the git profiles.');
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

        $configPath = $this->findConfigPath();

        if (empty($configPath)) {
            throw new \Exception("Can't detect .gitconfig file");
        }

        $config = file_get_contents($configPath);

        if (preg_match_all('~\[profile "(.*?)"\]~ui', $config, $found)) {
            $profiles = array_unique($found[1]);

            $output->writeln('');
            $output->writeln('Available profiles:');

            array_walk($profiles, function ($v) use ($output) {
                $output->writeln(sprintf('    %s', $v));
            });

            return;
        }

        throw new \Exception("Profiles aren't set");
    }

    /**
     * Finding .gitconfig file.
     *
     * @return bool|string
     */
    private function findConfigPath()
    {
        $configPath = '';

        if (isset($_SERVER['HOME'])) {
            // linux, macos, ...
            $configPath = sprintf('%s%s.gitconfig', $_SERVER['HOME'], DIRECTORY_SEPARATOR);
        } elseif (isset($_SERVER['HOMEPATH'])) {
            // windows
            $configPath = sprintf('%s%s.gitconfig', $_SERVER['HOMEPATH'], DIRECTORY_SEPARATOR);
        }

        if (!empty($configPath) && file_exists($configPath) && is_readable($configPath)) {
            return $configPath;
        }

        return false;
    }
}
