<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Not work in shared hosting

        // $schedule->command('inspire')->hourly();
        // $schedule->command('cache:clear')->daily();
        // $schedule->command('view:clear')->daily();

        // $schedule->command('status:otp')->everyMinute();
        // $schedule->command('status:fastwa')->everyMinute();
        // $schedule->command('broadcast:weekly')->mondays();
        // $schedule->command('broadcast:weekly')->fridays();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}