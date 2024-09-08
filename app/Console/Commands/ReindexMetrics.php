<?php

namespace App\Console\Commands;

use App\Reporting\Metrics\AbstractMetric;
use Illuminate\Console\Command;

class ReindexMetrics extends Command
{
    const METRICS_FILE_PATH = 'metrics_registration.json';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'metric:reindex {reset?} {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $frequency = 'daily';
        if (! file_exists(self::METRICS_FILE_PATH)) {
            return;
        }

        $metrics = file_get_contents(self::METRICS_FILE_PATH);
        foreach (json_decode($metrics, true) as $metric) {
            if (! class_exists($metric['class'])) {
                continue;
            }

            /** @var AbstractMetric $metric */
            $metric = new $metric['class']($metric['code']);
            if ($this->option('all')) {
                $metric->reindexAll();
            } else {
                $metric->reindex($frequency);
            }
        }
    }
}
