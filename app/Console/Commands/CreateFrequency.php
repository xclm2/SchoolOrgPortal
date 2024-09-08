<?php

namespace App\Console\Commands;

use App\Models\Metrics;
use Illuminate\Console\Command;
use App\Reporting\Frequency;

class CreateFrequency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metric:frequency {create} {--all} {--daily}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates frequency ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $frequency = new Frequency();
        if ($this->option('daily')) {
            if (Metrics::all()->count() < 1) {
                $frequency->createDailyFromStartDate();
                return;
            }

            $frequency->createDaily();
        }
    }
}
