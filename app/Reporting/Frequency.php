<?php
namespace App\Reporting;

use App\Models\Frequency as FrequencyModel;

class Frequency
{
    public function createDailyFromStartDate()
    {
        $startDate = '2024-08-02';
        while (strtotime($startDate) <= time()) {
            FrequencyModel::updateOrCreate([
                'frequency' => 'daily',
                'start_date' => $startDate . ' 00:00:00',
                'end_date' => $startDate . ' 23:59:59',
            ]);

            $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
        }
    }

    public function createDaily()
    {
        echo  date('Y-m-d') . ' 00:00:00';
        FrequencyModel::updateOrCreate([
            'frequency' => 'daily',
            'start_date' => date('Y-m-d') . ' 00:00:00',
            'end_date' => date('Y-m-d') . ' 23:59:59',
        ]);
    }

    public function createWeekly()
    {

    }

    public function createMonthly()
    {

    }
}
