<?php

namespace App\Console\Commands;

use App\Custom\Wallet as CustomWallet;
use App\Models\Coin;
use App\Models\PendingClearance;
use App\Models\SystemAccount;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProcessPendingClearance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:pendingClearance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process All Pending Clearnce into the account';

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
        $pendings = PendingClearance::where('status',2)->get();
        if ($pendings->count()>0) {
            foreach ($pendings as $pending) {
                $user = User::where('Investor_id',$pending->user)->first();
                switch ($pending->asset) {
                    case 'ETH':
                        $this->processEthTransfer($pending->asset,$user,$pending);
                        break;
                    // case 'MATIC':
                    //     $this->processEthTransfer($pending->asset,$user,$pending);
                    //     break;
                    // case 'TRON':
                    //         $this->processEthTransfer($pending->asset,$user,$pending);
                    //         break;
                    // case 'USDT_TRON':
                    //             $this->processEthTransfer($pending->asset,$user,$pending);
                    //             break;
                    default:
                        # code...
                        break;
                }
            }
        }
    }
    public function processEthTransfer($coin,$user,$data)
    {
        $wallet = Wallet::where('user',$user->Investor_id)->where('asset',$coin)->first();
        $gateway = new CustomWallet();
        $systemAccount = SystemAccount::where('asset',$coin)->first();
        $admin = User::where('is_admin',1)->first();
        $amount = str_replace(',','',$data->amount);
        $coin = Coin::where('asset',$coin)->first();
        //get the current gas fee and gas limit
        $dataTranferFee =[
            'from'=>$wallet->address,
            'to'=>$systemAccount->address,
            'amount'=>$amount
        ];
        $fee = $gateway->getEthGas($dataTranferFee);
        $amountToSend = $amount - 0.001176;

        $dataTransfer = [
            'address'=>$systemAccount->address,
            'amount'=>Str::remove(',',number_format($amountToSend,6)),
            'index'=>(int)$data->derivatiionKey,
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
                'message' => $transfer['message']
            ];
            //update data
            $update=PendingClearance::where('id',$data->id)->update($dataRecord);
        }else{
            $transfer = $transfer->json();
            $dataRecord = [
                'status'=>2,
                'message' => 'ErrorCode: ' . $transfer['errorCode'] . '; Error Message: ' . $transfer['message']
            ];
            //update data
            $update=PendingClearance::where('id',$data->id)->update($dataRecord);
            Log::alert($transfer);
        }
    }
    // public function processTronTransfer($coin,$user,$data)
    // {
    //     $wallet = Wallet::where('user',$user->id)->where('asset',$coin)->first();
    //     $gateway = new CustomWallet();
    //     $systemAccount = SystemAccount::where('asset',$coin)->first();
    //     $admin = User::where('is_admin',1)->first();
    //     $amount = str_replace(',','',$data->amount);
    //     $coin = Coin::where('asset',$coin)->first();
    //     //get the current gas fee and gas limit
    //     $dataTranferFee =[
    //         'from'=>$wallet->address,
    //         'to'=>$systemAccount->address,
    //         'amount'=>$amount
    //     ];
    //     $fee = $gateway->getEthGas($dataTranferFee);
    //     $amountToSend = $amount - 5;

    //     $dataTransfer = [
    //         'address'=>$systemAccount->address,
    //         'amount'=>$amountToSend,
    //         'index'=>$data->derivatiionKey,
    //         'mnemonic'=>Crypt::decryptString($systemAccount->mnemonic),
    //         'senderAccountId'=>$systemAccount->accountId,
    //         'fee'=>3
    //     ];
    //     //do the transfer
    //     $transfer = $gateway->createTransfer($coin->urlCode,$dataTransfer);
    //     if ($transfer->ok()) {
    //         //gather the result
    //         $transfer = $transfer->json();

    //         $dataRecord = [
    //             'status'=>1,
    //             'transHash'=>$transfer['txId']
    //         ];
    //         //update data
    //         $update=PendingClearance::where('id',$data->id)->update($dataRecord);
    //     }else{
    //         Log::alert($transfer->json());
    //     }
    // }
}
