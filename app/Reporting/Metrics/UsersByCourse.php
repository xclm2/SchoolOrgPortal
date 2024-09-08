<?php
namespace App\Reporting\Metrics;

use App\Models\Course;
use App\Models\Frequency;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersByCourse extends AbstractMetric
{
    protected $_course;

    public function getDailyQuery($frequencyID, $startDate, $endDate): string
    {
         return "SELECT $frequencyID, '$startDate', '$endDate', COUNT(course_id) as total, CONCAT('users_', course_id) FROM users WHERE course_id IS NOT NULL AND created_at <= '$endDate' GROUP BY course_id";
    }
}
