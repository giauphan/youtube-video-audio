<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class startQueue extends Command
{
    protected $signature = 'start:queue';
    protected $description = 'Command description';

    public function handle()
    {
        $check = Artisan::call('status:queue');

        if ($check) {
            $this->info('Scanning files is already running. Use "scan:scan-link" to check its status.');

            return true;
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $projectPath = base_path();

        $this->info('Starting queue work...'.now());

        $cmd = getenv('Path_PHP').' '.$projectPath.'/artisan queue:work';
        $process = Process::fromShellCommandline($cmd);
        $process->setTimeout(null);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info('Scanning files completed successfully. and sleep waint 60s');

            return;
        } else {
            $this->error('An error occurred while scanning files: '.$process->getErrorOutput().now());

            return 1;
        }
    }
}
