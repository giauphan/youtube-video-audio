<?php

namespace App\Console\Commands;

use App\Models\BotBlog;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class BotBLogCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:blog';

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
        $bot = BotBlog::query()->get();

        // Set the timezone to Asia/Ho_Chi_Minh
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $projectPath = base_path();

        $this->info('Starting bot blog work...' . now());

        foreach ($bot as  $botrun) {

            $post_url = $botrun->post_url;
            $category_post = $botrun->category_post;
            $lang = $botrun->lang;
            $limit_blog = $botrun->limit_blog;

            $cmd = getenv('Path_PHP') . ' ' . $projectPath . "/artisan crawl:BotBlogTechNewsWorld $post_url $category_post $lang $limit_blog";
            $process = Process::fromShellCommandline($cmd);
            $process->setTimeout(null);
            $process->run();

            if ($process->isSuccessful()) {
                $this->info('Scanning files completed successfully. and sleep waint 60s');
            } else {
                $this->error('An error occurred while scanning files: ' . $process->getErrorOutput() . now());
            }
        }
    }
}
