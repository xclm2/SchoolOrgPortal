<?php
namespace App\Reporting\Metrics;

use App\Models\Course;
use App\Models\Frequency;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersByCourse extends AbstractMetric
{
    public function getDailyQuery($frequencyID, $startDate, $endDate): string
    {
        $select = "SELECT $frequencyID, '$startDate', '$endDate', IFNULL(temp.total_count, 0), CONCAT('users_', id) as code";
        $select .= " FROM courses as c";
        $select .= " LEFT JOIN (SELECT COUNT(course_id) as total_count, course_id FROM users WHERE course_id IS NOT NULL AND created_at <= '$endDate' GROUP BY course_id) as temp";
        $select .= " ON temp.course_id = c.id";
        return $select;
    }
}
