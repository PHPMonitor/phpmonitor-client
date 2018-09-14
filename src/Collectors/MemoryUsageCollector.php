<?php

namespace Sopamo\PHPMonitor\Collectors;

use Sopamo\PHPMonitor\Metric;

class MemoryUsageCollector implements CollectorInterface {

    /**
     * Returns the cpu load averages for 1, 5 and 15 minutes
     *
     * @return Metric[]
     */
    public function collect()
    {
        return [
            new Metric('memory.usage', $this->getMemoryUsage()),
        ];
    }

    /**
     * Returns the percentage of used memory
     *
     * @return float
     */
    private function getMemoryUsage() {
        $free = shell_exec('free');
        $free = (string)trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem);
        $mem = array_merge($mem);
        $memory_usage = $mem[2] / $mem[1];

        return round($memory_usage, 2);
    }
}