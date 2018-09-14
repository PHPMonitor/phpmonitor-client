<?php

namespace Sopamo\PHPMonitor\Collectors;

use Sopamo\PHPMonitor\Metric;

class CPULoadCollector implements CollectorInterface {

    /**
     * Returns the cpu load averages for 1, 5 and 15 minutes
     *
     * @return Metric[]
     */
    public function collect()
    {
        $loadAvg = sys_getloadavg();
        return [
            new Metric('cpu.loadavg.1', $loadAvg[0]),
            new Metric('cpu.loadavg.5', $loadAvg[1]),
            new Metric('cpu.loadavg.15', $loadAvg[2]),
        ];
    }
}