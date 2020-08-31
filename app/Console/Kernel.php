<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        //
    ];


    protected function schedule(Schedule $schedule)
    {
        // PERCORRE AS CONTAS ATRASADAS (DIÁRIO)
        $schedule->command('bill:overdue')->daily();

        // ATUALIZA BASE DE TAXAS DE CÂMBIO (SEMANAL)
        $schedule->command('configs:exchange')->weekly();

    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
