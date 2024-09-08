<?php
namespace App\Reporting\Metrics;

use App\Models\Frequency;
use App\Models\Metrics;
use Illuminate\Support\Facades\DB;

abstract class AbstractMetric
{
    public function __construct(protected $_code)
    {}

    const INSERT_COLUMNS = ['frequency_id', 'start_date', 'end_date', 'total', 'code'];

    public function reindexAll(): void
    {
        $frequencies = Frequency::all();
        foreach ($frequencies as $frequency) {
            $selectData = $this->getDailyQuery($frequency->id, $frequency->start_date, $frequency->end_date) . ' ON DUPLICATE KEY UPDATE total = total';
            DB::table('metrics')->insertUsing(self::INSERT_COLUMNS, $selectData);
        }
    }

    /**
     * TODO: implement weekly, monthly, and yearly
     *
     * @param string $frequency
     * @return void
     */
    public function reindex(string $frequency): void
    {
        $frequency = Frequency::all()->where('frequency', $frequency)->last();
        $selectData = "";
        switch ($frequency) {
            case 'weekly':
            case 'monthly':
            case 'yearly':
                break;
            default:
                $selectData = $this->getDailyQuery($frequency->id, $frequency->start_date, $frequency->end_date);
                break;
        }

        if (empty($selectData)) {
            return;
        }

        DB::table('metrics')->insertUsing(self::INSERT_COLUMNS, "$selectData  ON DUPLICATE KEY UPDATE total = VALUE(total)");
    }

    abstract public function getDailyQuery($frequencyID, $startDate, $endDate): string;
}
