<?php 

namespace Zeeshan\GitProfile\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Process\Process;

/**
 * @package GitProfile
 * @author  Zeeshan Ahmed<ziishaned@gmail.com>
 */
class BaseCommand extends Command
{

	/**
	 * Run the command
	 * 
	 * @param  string  $command
	 * @param  boolean $mustRun
	 * @return mixed
	 */
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