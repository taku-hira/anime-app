<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScrapeAnimeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:animeData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scrape animeData';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo 10 . PHP_EOL;
        return 0;
    }
}
