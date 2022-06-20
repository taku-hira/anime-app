<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\NotificationEmailController;

class sendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notification = new NotificationEmailController;
        $notification->send();
    }
}
