<?php

namespace App\Console\Commands;

use App\Models\Staking;
use App\Models\StakingReturn;
use App\Models\User;
use App\Notifications\AccountNotification;
use Illuminate\Console\Command;

class StakingReturns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'staking:returns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns active stakings';

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
        $stakings = Staking::where('status',4)->get();
        if ($stakings->count()>0) {
            foreach ($stakings as $staking) {
                $user = User::where('id',$staking->user)->first();
                $moment = time();
                if ($staking->nextReturn <= $moment) {
                    $currentReturn = $staking->currentReturn;
                    $numberOfReturn = $staking->numberOfReturn;
                    $amountCredit = $staking->profitPerReturn;
                    $currentProfit = $staking->currentProfit;
                    $capital = $staking->amount;
                    if ($currentReturn < $numberOfReturn) {
                        $numReturn = $currentReturn+1;
                        $newProfit = $currentProfit+$amountCredit;
                        $dataStaking=[
                            'currentProfit'=>$newProfit,
                            'currentReturn'=>$numReturn,
                            'nextReturn'=>strtotime($staking->returnType,time())
                        ];
                        $dataReturns=[
                            'amount'=>$amountCredit,
                            'stakingId'=>$staking->id,
                            'user'=>$user->id
                        ];

                        $update = Staking::where('id',$staking->id)->update($dataStaking);
                        StakingReturn::create($dataReturns);
                        if($update){
                            //check the transaction
                            $newStaking = Staking::where('id',$staking->id)->first();
                            if ($newStaking->currentReturn == $numberOfReturn) {
                                $dataStaking2 =['status'=>1,'nextReturn'=>time()];
                                $dataBalance =['profit'=>$user->profit+$newStaking->currentProfit+$capital];
                                //update the staking
                                $updateStaking = Staking::where('id',$newStaking->id)->update($dataStaking2);
                                if ($updateStaking) {
                                    User::where('id',$user->id)->update($dataBalance);
                                    $message ='Your investment of $<b>'.number_format($staking->amount,2).'</b>
                                    has completed.
                                    Your profit balance has been credited with
                                    $<b>'.number_format($newStaking->currentProfit,2).'</b>.
                                    Your new available balance is <b>$'.number_format($user->profit+$newStaking->currentProfit+$newStaking->amount,2).'</b>';
                                    $user->notify(new AccountNotification($user->name,$message,null,
                                        'Completed Investment'));
                                }
                            }else{
                                $message ='Your investment of <b>$'.number_format($staking->amount,2).'</b> has returned an earning of
                                 <b>$'.number_format($amountCredit,2).'</b>. Your current earning is <b>$'.number_format($newStaking->currentProfit,2).'</b>';
                                $user->notify(new AccountNotification($user->name,$message,null,'Investment Return'));
                            }
                        }
                    }
                }
            }
        }
    }
}
