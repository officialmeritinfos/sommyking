<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Models\CurrencyAccepted;
use App\Models\UserBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class createBalance
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        //check for the active account balances
        $currencies = CurrencyAccepted::where('status',1)->get();
        foreach ($currencies as $currency) {
                //get user's balance that corresponds to given code
                $userBalance = UserBalance::where('currency',$currency->code)->where('user',$user->id)->first();
                if (empty($userBalance)){
                    $dataBalance = [
                        'user'=>$user->id,
                        'currency'=>$currency->code,
                        'availableBalance'=>0,
                        'frozenBalance'=>0,
                        'referralBalance'=>0,
                        'TransactionLimit'=>$currency->unverifiedIndividualTransactionLimit,
                        'AccountLimit'=>$currency->unverifiedIndividualLimit,
                        'status'=>1
                    ];
                    UserBalance::create($dataBalance);
                }
        }
    }
}
