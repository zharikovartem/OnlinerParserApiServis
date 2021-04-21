<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

<<<<<<< HEAD
use App\Services\Parsers\OnlinerParser;

=======
>>>>>>> first commit
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
<<<<<<< HEAD
        \App\Console\Commands\TestServer::class,
        \App\Console\Commands\PushServer::class,
=======
        //
>>>>>>> first commit
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
<<<<<<< HEAD
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('onliner:parse')->cron('* * * *');
=======
        // $schedule->command('inspire')->hourly();
>>>>>>> first commit
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
