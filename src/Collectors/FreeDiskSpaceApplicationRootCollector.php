<?php

namespace Sopamo\PHPMonitor\Collectors;

use Sopamo\PHPMonitor\Metric;

class FreeDiskSpaceApplicationRootCollector implements CollectorInterface {

    /**
     * Returns the free disk space for the application root
     *
     * @return Metric[]
     */
    public function collect()
    {
        $freeSpace = disk_free_space(dirname(dirname(dirname(dirname(__DIR__)))));
        return [
            new Metric('disks.freespace.applicationroot', $freeSpace),
        ];
    }
}