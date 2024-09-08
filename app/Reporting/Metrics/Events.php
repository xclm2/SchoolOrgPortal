<?php
namespace App\Reporting\Metrics;

class Events extends AbstractMetric
{
    public function getDailyQuery($frequencyID, $startDate, $endDate): string
    {
        $select = "SELECT $frequencyID, '$startDate', '$endDate', COUNT(op.id) as total, CONCAT('events_org_', o.id)";
        $select .= " FROM organization AS o";
        $select .= " LEFT JOIN organization_post AS op ON op.organization_id = o.id";
        $select .= " WHERE op.created_at <= '$endDate' OR op.created_at IS NULL";
        $select .= " GROUP BY o.id";
        return $select;
    }
}
