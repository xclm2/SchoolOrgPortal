<?php
namespace App\Reporting;

use App\Reporting\Metrics\AbstractMetric;
use App\Reporting\Metrics\Users;
use App\Reporting\Metrics\UsersByCourse;

class Data
{
    protected string $_code;

    public static array $METRICS = [
        'users' => Users::class,
        'users_by_course' => UsersByCourse::class,
    ];

    public function __construct(string $metricCode)
    {
        if (! array_key_exists($metricCode, self::$METRICS)) {
            throw new \InvalidArgumentException('Metric ' . $metricCode . ' does not exist.');
        }

        $this->_code = $metricCode;
    }

    public function reindex(string $frequency = 'daily')
    {
        /** @var AbstractMetric $metric */
        $metric = new self::$METRICS[$this->_code]($this->_code);
        $metric->reindex($frequency);
    }
}
