<?php

namespace Sopamo\PHPMonitor;

use Sopamo\PHPMonitor\Collectors\CollectorInterface;

class PHPMonitor {

    /** @var Metric[] $metrics */
    private $metrics = [];

    /**
     * Collects the metrics from the given collectors
     *
     * @param string[] $collectors
     */
    public function collect($collectors) {
        foreach ($collectors as $collectorClassName) {
            /** @var CollectorInterface $collector */
            $collector = new $collectorClassName;
            $this->metrics = array_merge($this->metrics, $collector->collect());
        }
    }

    public function submit() {
        $client = new \GuzzleHttp\Client();
        $data = [];
        foreach($this->metrics as $metric) {
            $data[$metric->getKey()] = $metric->getValue();
        }
        $res = $client->request('POST', config('phpmonitor.endpoint') . '/default/stats-create', [
            'json' => [
                "server" => config('phpmonitor.server'),
                "account" => config('phpmonitor.account'),
                "data" => $data,
            ],
            'headers' => [
                'X-PHPMONITOR-SECRET' => config('phpmonitor.secret')
            ]
        ]);
        echo $res->getStatusCode() . "\n";
        $this->data = [];
    }
}