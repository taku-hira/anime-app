<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\OnAirDataController;

class scrapeOnAirData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:onAirData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get On Air Data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scraping = new OnAirDataController();
        $scraping->getOnAirData();
    }
}
