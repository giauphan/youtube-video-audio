<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class statusQueue extends Command
{
    protected $signature = 'status:queue';
    protected $description = 'Command description';

    public function handle()
    {
        $processes = Process::fromShellCommandline('ps aux | grep "artisan queue:work" | grep -v grep');
        $processes->run();
        if ($processes->isSuccessful() && $processes->getOutput()) {
            $this->info('The scan:change-link command is running.'.$processes->getOutput().now());

            return 1;
        } else {
            $this->info('The scan:change-link command is not  running. ');

            return 0;
        }
    }
}
