<?php 

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Process;

class BaseCommand extends Command
{
	public function runCommand($command, $mustRun = false)
	{
		try {
			$process = new Process($command);
			$process->mustRun();

			return trim($process->getOutput());
		} catch (Exception $e) {
			if ($mustRun) {
				throw $e;
			}

			return '';
		}
	}	
}