<?php

namespace Sopamo\PHPMonitor\Collectors;

use Sopamo\PHPMonitor\Metric;

interface CollectorInterface {
    /**
     * Returns an array of metrics
     *
     * @return Metric[]
     */
    public function collect();
}