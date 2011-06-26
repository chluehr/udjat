<?php

namespace Udjat\Document;

/**
 * 
 */
class MetricValue
{

    /**
     * @var Y-m-d H:i:s
     */
    public $datetime;

    /**
     * @var string
     */
    public $host;

    /**
     * @var string
     */
    public $service;

    /**
     * @var string
     */
    public $metric;

    /**
     * @var int|float
     */
    public $value;
}
