<?php

namespace App\Console\Commands;

use App\Custom\Wallet as CustomWallet;
use App\Models\Coin;
use App\Models\SystemAccount;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessPayout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:Payout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Payouts';

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
        $payouts = Withdrawal::where('status',4)->where('isSystem',1)->get();
        if ($payouts->count()>0) {
            foreach ($payouts as $payout) {
                if($payout->isSystem !=1)
                {
                    $user = User::where('Investor_id',$payout->user)->first();
                }else{
                    $user = '';
                }
                switch ($payout->asset) {
                    case 'ETH':
                        $this->processEthTransfer($payout->asset,$user,$payout);
                        break;
                    default:
                        $this->processOtherTransfer($payout->asset,$user,$payout);
                        break;
                }
            }
        }
    }
    public function processEthTransfer($coin,$user,$data)
    {
        //$wallet = Wallet::where('user',$user->Investor_id)->where('asset',$coin)->first();
        $gateway = new CustomWallet();
        $systemAccount = SystemAccount::where('asset',$coin)->first();
        $admin = User::where('is_admin',1)->first();
        $amount = str_replace(',','',$data->amount);
        $coin = Coin::where('asset',$coin)->first();
        //get the current gas fee and gas limit
        // $dataTranferFee =[
        //     'from'=>$wallet->address,
        //     'to'=>$systemAccount->address,
        //     'amount'=>$amount
        // ];
        // $fee = $gateway->getEthGas($dataTranferFee);
        $amountToSend = $amount - 0.001176;

        $dataTransfer = [
            'address'=>$data->addressTo,
            'amount'=>Str::remove(',',number_format($amountToSend,6)),
            'index'=>(int)$data->derivationKey,
            'gasLimit'=>"21000",
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
                'transHash'=>$transfer['txId'],
                'message'=>'Completed',
                'tatumId'=>$transfer['id']
            ];
            //update data
            $update=Withdrawal::where('id',$data->id)->update($dataRecord);
            if($data->isSystem !=1){
                $dataBalance =[
                    'availableBalance'=>$systemAccount->availableBalance-$amount
                ];
                SystemAccount::where('id',$systemAccount->id)->update($dataBalance);
            }
        }else{
            $transfer = $transfer->json();
            $dataRecord = [
                'status'=>2,
                'message'=>'ErrorCode: '.$transfer['errorCode'].'; Error Message: '.$transfer['message']
            ];
            //update data
            $update=Withdrawal::where('id',$data->id)->update($dataRecord);
            Log::info($transfer);
        }
    }
    public function processOtherTransfer($coin,$user,$data)
    {
        // $wallet = Wallet::where('user',$user->Investor_id)->where('asset',$coin)->first();
        $gateway = new CustomWallet();
        $systemAccount = SystemAccount::where('asset',$coin)->first();
        $admin = User::where('is_admin',1)->first();
        $amount = str_replace(',','',$data->amount);
        $coin = Coin::where('asset',$coin)->first();

        $amountToSend = $amount - $coin->fee;

        $dataTransfer = [
            'address'=>$data->addressTo,
            'amount'=>Str::remove(',',number_format($amountToSend,6)),
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
                'transHash'=>$transfer['txId'],
                'message'=>'Completed',
                'tatumId'=>$transfer['id']
            ];
            //update data
            Withdrawal::where('id',$data->id)->update($dataRecord);
//            if($data->isSystem !=1){
//                $dataBalance =[
//                    'availableBalance'=>$systemAccount->availableBalance-$amount
//                ];
//                SystemAccount::where('id',$systemAccount->id)->update($dataBalance);
//            }
        }else{
            $transfer = $transfer->json();
            $dataRecord = [
                'status'=>2,
                'message'=>'ErrorCode: '.$transfer['errorCode'].'; Error Message: '.$transfer['message']
            ];
            //update data
            $update=Withdrawal::where('id',$data->id)->update($dataRecord);
            Log::info($transfer);
        }
    }
}
