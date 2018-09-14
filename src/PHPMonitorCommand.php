<?php

namespace Sopamo\PHPMonitor;

use Illuminate\Console\Command;
use Sopamo\PHPMonitor\Collectors\CPULoadCollector;
use Sopamo\PHPMonitor\Collectors\FreeDiskSpaceApplicationRootCollector;
use Sopamo\PHPMonitor\Collectors\MemoryUsageCollector;

class PHPMonitorCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'phpmonitor:track';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the current system status to phpmonitor';
    /**
     * @var PHPMonitor
     */
    private $PHPMonitor;

    /**
     * Create a new command instance.
     *
     */
    public function __construct(PHPMonitor $PHPMonitor)
    {
        parent::__construct();
        $this->PHPMonitor = $PHPMonitor;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $collectors = [
            CPULoadCollector::class,
            FreeDiskSpaceApplicationRootCollector::class,
            MemoryUsageCollector::class,
        ];
        while(true) {
            $this->PHPMonitor->collect($collectors);

            $this->PHPMonitor->submit();
            sleep(10);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }
}
