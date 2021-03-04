<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\AmmortizationSchedule;
use App\TransactionLogs;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $current_date =  date("Y-m-d");
            $amt_schedule = AmmortizationSchedule::where('penalty', '=' , 0)
            ->where('balance', '<>', 0)
            ->get();
            foreach($amt_schedule as $amts){
                $due_date = $amts->due_date;
                if($current_date > $due_date){
                    $day_diff = strtotime($current_date) - strtotime($due_date);
                    $final_day = round($day_diff / (60 * 60 * 24));
                    if($final_day >= 3){
                        $amt_schedule_id = $amts->id;
                        $due_amount = $amts->due_ammount;
                        $penalty = (double)$due_amount * 0.3;
                        $balance = $due_amount + $penalty;
    
                        $amts_update = AmmortizationSchedule::find($amt_schedule_id);
                        $amts_update->penalty = $penalty;
                        $amts_update->balance = $balance;
                        $amts_update->due_ammount = $balance;
                        $amts_update->days_due = $final_day;
                        $amts_update->save();

                        $trans_log = new TransactionLogs();
                        $trans_log->transaction_type = 'PAYMENT PENALTY';
                        $trans_log->transaction_id = $amt_schedule_id;
                        $trans_log->previous_amt = $amts->balance;
                        $trans_log->current_amt = $balance;
                        $trans_log->save();

                    }
                }
            }
        })->everyMinute();

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
