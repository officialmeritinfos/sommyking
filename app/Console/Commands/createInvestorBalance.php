<?php

namespace App\Console\Commands;

use App\Models\Balance;
use App\Models\BalanceType;
use App\Models\User;
use Illuminate\Console\Command;

class createInvestorBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:investorBalance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates investors balances';

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
        $balanceTypes = BalanceType::where('status',1)->get();
        if ($balanceTypes->count()>0) {
           foreach($balanceTypes as $balanceType){
                $users = User::get();
                if ($users->count()>0) {
                    foreach ($users as $user) {
                        $balanceExists = Balance::where('user',$user->id)->where('asset',$balanceType->asset)->first();
                        if(empty($balanceExists)){
                            $dataBalance=[
                                'user'=>$user->id,
                                'asset'=>$balanceType->asset,
                                'isUsd'=>$balanceType->isUsd
                            ];
                            //create it
                            Balance::create($dataBalance);
                        }
                    }
                }
            }
        }
    }
}
