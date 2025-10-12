<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ClearLogs extends Command
{
    protected $signature = 'logs:clear';
    protected $description = 'Clear application logs';

    public function handle()
    {
        $logFile = storage_path('logs/laravel.log');

        if (File::exists($logFile)) {
            File::put($logFile, '');
            $this->info('Logs cleared successfully!');
        } else {
            $this->info('No log file found.');
        }
    }
}
