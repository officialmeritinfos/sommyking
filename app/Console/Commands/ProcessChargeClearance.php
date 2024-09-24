<?php

namespace App\Console\Commands;

use App\Custom\Wallet;
use App\Models\ChargeClearance;
use App\Models\Coin;
use App\Models\SystemAccount;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessChargeClearance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:chargeClearance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes Clearing the Charges';

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
        $charges = ChargeClearance::where('status',2)->get();
        if ($charges->count()>0) {
            foreach ($charges as $payout) {
                switch ($payout->asset) {
                    case 'ETH':
                        $this->processEthTransfer($payout->asset,$payout);
                        break;
                    default:
                        $this->processOtherTransfer($payout->asset,$payout);
                        break;
                }
            }
        }
    }
    public function processEthTransfer($coin,$data)
    {
        $gateway = new Wallet();
        $amount = str_replace(',','',$data->amount);
        $coin = Coin::where('asset',$coin)->first();
        $systemAccount = SystemAccount::where('asset',$coin)->first();

        $fee=0.00168;
        $amountToSend = $amount - $fee;
        if ($amountToSend > $fee) {
            $dataTransfer = [
                'address'=>$data->addressTo,
                'amount'=>Str::remove(',',number_format($amountToSend,10)),
                'index'=>$data->derivationKey,
                'gasLimit'=>"2100",
                'gasPrice'=>"56",
                'mnemonic'=>Crypt::decryptString($systemAccount->mnemonic),
                'senderAccountId'=>$systemAccount->accountId
            ];
            //do the transfer
            $transfer = $gateway->createTransfer($coin->urlCode,$dataTransfer);
            if ($transfer->ok()) {
                //gather the result
                $transfer = $transfer->json();

                $dataRecord = [
                    'status'=>1,
                    'txId'=>$transfer['txId']
                ];
                //update data
                ChargeClearance::where('id',$data->id)->update($dataRecord);
                // $dataBalance =[
                //     'availableBalance'=>$systemAccount->availableBalance-$amount
                // ];
                // SystemAccount::where('id',$systemAccount->id)->update($dataBalance);
            }else{
                Log::info($transfer->json());
            }
        }
    }
    public function processOtherTransfer($coin,$data)
    {

        $gateway = new Wallet();
        $systemAccount = SystemAccount::where('asset',$coin)->first();
        $admin = User::where('is_admin',1)->first();
        $amount = str_replace(',','',$data->amount);
        $coin = Coin::where('asset',$coin)->first();
        $amountToSend = $amount - $coin->fee;

        $dataTransfer = [
            'address'=>$data->addressTo,
            'amount'=>Str::remove(',',number_format($amountToSend,10)),
            'xpub'=>$systemAccount->pubKey,
            'mnemonic'=>Crypt::decryptString($systemAccount->mnemonic),
            'senderAccountId'=>$systemAccount->accountId,
            'fee'=>$coin->fee
        ];
        //do the transfer
        $transfer = $gateway->createTransfer($coin->urlCode,$dataTransfer);
        if ($transfer->ok()) {
            //gather the result
            $transfer = $transfer->json();

            $dataRecord = [
                'status'=>1,
                'txId'=>$transfer['txId']
            ];
            //update data
            ChargeClearance::where('id',$data->id)->update($dataRecord);

        }else{
            Log::info($transfer->json());
        }
    }
}
