<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\InitializeSystemAccount;
use App\Console\Commands\InitializeSubscription;
use App\Console\Commands\InitializeUserWallet;
use App\Console\Commands\ProcessPendingClearance;
use App\Console\Commands\ProcessPayout;
use App\Console\Commands\ProcessChargeClearance;
use App\Console\Commands\CachCryptoRates;
use App\Console\Commands\UpdateBalance;
use App\Console\Commands\updateWithdrawalRate;
use App\Console\Commands\createInvestorBalance;
use App\Console\Commands\StakingReturns;

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
        // $schedule->command('inspire')->hourly();
        // $schedule->command('initialize:systemAccount')->everyMinute()->withoutOverlapping();
        // $schedule->command('initialize:susbcription')->everyMinute()->withoutOverlapping();
        // $schedule->command('initialize:userWallet')->everyMinute()->withoutOverlapping();
        // //$schedule->command('process:pendingClearance')->everyMinute()->withoutOverlapping();
        // $schedule->command('process:Payout')->everyMinute()->withoutOverlapping();
        // $schedule->command('process:chargeClearance')->everyMinute()->withoutOverlapping();
        // $schedule->command('cache:cryptoRates')->everyMinute()->withoutOverlapping();
        $schedule->command('staking:returns')->everyMinute()->withoutOverlapping();
        // $schedule->command('update:balance')->everyMinute()->withoutOverlapping();
        // $schedule->command('update:withdrawalRate')->everyFiveMinutes()->withoutOverlapping();
        // $schedule->command('create:investorBalance')->everyMinute()->withoutOverlapping();
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
