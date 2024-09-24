<?php

namespace App\Console\Commands;

use App\Custom\Wallet;
use App\Models\SystemAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InitializeSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize:susbcription';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Subscription for all the coins supported by the system';
    public $wallet;
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
        $systemAccounts = SystemAccount::where('hasSub','!=',1)->get();
        if($systemAccounts->count() > 0){
            foreach ($systemAccounts as $systemAccount) {
                $incomingLink = url('transactions/incoming/'.$systemAccount->customId.'/account/'.$systemAccount->accountId);;
                $dataIncoming=[
                    'type'              => 'ACCOUNT_INCOMING_BLOCKCHAIN_TRANSACTION',
                    'attr'              =>[
                        'id'            =>$systemAccount->accountId,
                        'url'           =>$incomingLink
                    ]
                ];
                $wallet=new Wallet();
                $incomingData=$wallet->createSubscription($dataIncoming);
                if ($incomingData->ok()){
                    $incomings=$incomingData->json();
                    $dataSub=[
                        'subId'=>$incomings['id'],
                        'hasSub'=>1
                    ];
                    //update the data
                    SystemAccount::where('id',$systemAccount->id)->update($dataSub);
                }else{
                    //Log::alert($incomingData->json());
                }
            }
        }
    }
}
