<?php

namespace App\Console\Commands;

use App\Custom\Regular;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Console\Command;

class updateWithdrawalRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:withdrawalRate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates withdrawal rate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo $this->updateDeposit();
    }

    public function updateDeposit()
    {
        $deposits = Deposit::where('hasConverted','!=',1)->get();
        if ($deposits->count()>0){
            foreach ($deposits as $deposit) {
                $regular = new Regular();
                $rate = $regular->getCryptoExchange($deposit->asset);
                if ($rate !=0){
                    $fiatAmount = $rate * $deposit->amount;
                    $user = User::where('id',$deposit->user)->first();

                    $data = [
                        'hasConverted'=>1,
                        'fiat'=>$fiatAmount
                    ];
                    $dataBalance = [
                        'balance'=>$user->balance+$fiatAmount
                    ];
                    Deposit::where('id',$deposit->id)->update($data);
                    User::where('id',$user->id)->update($dataBalance);
                }
            }
            return 'ok';
        }
    }
}
