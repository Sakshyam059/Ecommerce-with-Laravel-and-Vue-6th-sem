<?php

namespace App\Console;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        
        $schedule
            ->call(function () {
                Order::where('payment_status',"failed")->first()->delete();              
            })
            ->everyFiveSeconds();
        $schedule
            ->call(function () {
                Payment::where('payment_mode',"khalti")->first()->delete();
            })
            ->everyFiveSeconds();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
