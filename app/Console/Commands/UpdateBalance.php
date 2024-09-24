<?php

namespace App\Console\Commands;

use App\Custom\Wallet;
use App\Models\SystemAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update System Balance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->wallet = new Wallet();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $systemAccount = SystemAccount::where('status',1)->get();
        foreach ($systemAccount as $sysAccount) {
            $userAccount=$this->wallet->getBalance($sysAccount->accountId);
            if ($userAccount->ok()){
                $userAccount=$userAccount->json();
                $dataAccount=[
                    'availableBalance'  =>$userAccount['availableBalance']
                ];
                //update record
                SystemAccount::where('id',$sysAccount->id)->update($dataAccount);
                
            }else{
                Log::alert($userAccount->json());
            }
        }
    }
}
