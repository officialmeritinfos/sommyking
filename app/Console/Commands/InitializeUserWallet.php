<?php

namespace App\Console\Commands;

use App\Custom\GenerateUnique;
use App\Models\Coin;
use App\Models\SystemAccount;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;
use App\Custom\Wallet as Wallets;
use Illuminate\Support\Facades\Log;

class InitializeUserWallet extends Command
{
    use GenerateUnique;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize:userWallet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializes the User Wallet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->wallet = new Wallets();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $coins = Coin::where('status',1)->get();
        if ($coins->count()>0) {
            foreach ($coins as $coin) {
                //check if the coin has been initialized earlier
                $systemAccount = SystemAccount::where('asset',$coin->asset)->first();
                if (!empty($systemAccount)) {
                    $users = User::get();
                    if ($users->count()>0) {
                        foreach ($users as $user) {
                            //check if the currency exists in the user's wallet
                            $walletExists = Wallet::where('user',$user->id)->where('asset',$coin->asset)->first();
                            if (empty($walletExists)) {
                                //generate the address
                                $accountId = $systemAccount->accountId;
                                //create a deposit address
                                $generateAddress = $this->wallet->generateAddress($accountId);
                                if ($generateAddress->ok()) {
                                    if ($coin->hasMemo==1) {
                                        $memo = $generateAddress['memo'];
                                    }else{
                                        $memo='';
                                    }
                                    $dataAddress = [
                                        'asset' => $coin->asset,
                                        'user'=>$user->id,
                                        'accountId' => $accountId,
                                        'address' => str_replace('bitcoincash:','',$generateAddress['address']),
                                        'hasMemo' => $coin->hasMemo,
                                        'memo'=>$memo,
                                        'priKey'=>'',
                                        'mnemonic'=>'',
                                        'pubKey'=>'',
                                        'derivationKey'=>$generateAddress['derivationKey'],
                                        'customId'=>$this->createUniqueRef('wallets','customId'),
                                    ];
                                    Wallet::create($dataAddress);
                                }else{
                                    //Log::alert($generateAddress->json());
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
