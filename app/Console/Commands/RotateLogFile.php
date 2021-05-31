<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RotateLogFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rotate:log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto rotate log file';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $logPath = storage_path('logs/laravel.log');
        $newPath = storage_path('logs/laravel.log.' . Carbon::yesterday()->format('Ymd'));
        File::move($logPath, $newPath);
    }
}
