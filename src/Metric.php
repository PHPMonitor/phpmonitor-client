<?php

namespace Sopamo\PHPMonitor;

class Metric {

    private $key;
    private $value;

    public function __construct($key, $value)
    {
        $this->key = (string) $key;
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}