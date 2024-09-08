<?php
namespace App\Reporting\Metrics;

class Users extends AbstractMetric
{
    public function getDailyQuery($frequencyID, $startDate, $endDate): string
    {
        return "SELECT $frequencyID, '$startDate', '$endDate', COUNT(*) as total, '$this->_code' FROM users WHERE created_at BETWEEN '$startDate' AND '$endDate'";
    }
}
