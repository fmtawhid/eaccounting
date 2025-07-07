<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunScheduledFeesCommands extends Command
{
    protected $signature = 'fees:run-continuous';
    protected $description = 'Continuously run fees assignment commands every second';

    public function handle()
    {
        $this->info("🚀 Starting continuous fees assignment... (Ctrl+C to stop)");

        while (true) {
            $this->call('fees:assign-regular');
            $this->call('fees:assign-optional');

        }
    }
}
