<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\ChargeClearance;
use App\Models\ChargeWallet;
use App\Models\Coin;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\PendingClearance;
use App\Models\SystemAccount;
use App\Models\SystemIncoming;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\AccountNotification;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function incoming(Request $request, $customId,$accountId)
    {
        //get the payload from tatum.io
        $asset=$request->input('currency');
        $amount=$request->input('amount');
        $id=$request->input('accountId');
        $datePaid=$request->input('date');
        $txId=$request->input('txId');
        $blockHeight=$request->input('blockHeight');
        if ($request->has('from')){
            $addressFrom=$request->input('from');
        }else{
            $addressFrom='';
        }
        if ($request->has('blockHash')){
            $blockHash=$request->input('blockHash');
        }else{
            $blockHash='';
        }
        $addressTo=$request->input('to');

        //check if the currency has memo
        $coin = Coin::where('asset',strtoupper($asset))->first();
        //get the balance that has the address
        $wallet = Wallet::where('address',$addressTo)->first();

        $user = User::where('id',$wallet->user)->first();
        //calculate charges
        $coinExist = Coin::where('asset',strtoupper($asset))->first();
        $amountReceived = $request->input('amount');
        $charge = $coinExist->charge;
        $amountToSend = $amountReceived*($charge/100);
        $amountToCredit = $amountReceived - $amountToSend;
        //if amount received is too small, send to charge
//        if ($amount < $coinExist->minReceive) {
//            return $this->addToSystemCharge($asset,$amountToSend);
//        }
        //lets check and see that the transaction is not a duplicate
        $depositExists = Deposit::where('transHash',$txId)->first();
        if (!empty($depositExists)) {
            //check if the amoun is the same
            if ($depositExists->amount == $amountToCredit) {
                $add = 2;
            }else{
                $add = 1;
            }
        }else{
            $add = 1;
        }
        if ($add ==1) {
            $admin = GeneralSetting::where('id',1)->first();
            if (!empty($wallet)) {

                $user = User::where('id',$wallet->user)->first();
                $systemAccount = SystemAccount::where('asset',strtoupper($asset))->first();
                //$balance = Balance::where('user',$wallet->user)->where('asset',$wallet->asset)->first();

                $admin = User::where('is_admin',1)->first();
                $newBalance = $wallet->availableBalance+$amountToCredit;
                $dataBalance = ['availableBalance'=>$newBalance];
                $dataDeposit =[
                    'user'=>$wallet->user,
                    'asset'=>strtoupper($asset),
                    'addressFrom'=>$addressFrom,
                    'addressTo'=>$addressTo,
                    'accountId'=>$id,
                    'transHash'=>$txId,
                    'blockHeight'=>$blockHeight,
                    'blockHash'=>$blockHash,
                    'status'=>1,
                    'amount'=>$amountToCredit
                ];
                //create a transfer for the coin to the main account
                $this->addToSystemCharge($asset, $amountToSend,$user);

                $update = Wallet::where('id',$wallet->id)->update($dataBalance);
                if ($update) {
                    Deposit::create($dataDeposit);
                    $dataIncoming =[
                        'asset'=>strtoupper($asset),
                        'addressFrom'=>$addressFrom,
                        'addressTo'=>$addressTo,
                        'accountId'=>$id,
                        'transHash'=>$txId,
                        'blockHeight'=>$blockHeight,
                        'blockHash'=>$blockHash,
                        'status'=>1,
                        'amount'=>$amountToCredit
                    ];
                    $dataSySBalance =[
                        'availableBalance'=>$systemAccount->availableBalance+$amountToCredit
                    ];
                    SystemAccount::where('id',$systemAccount->id)->update($dataSySBalance);
                    SystemIncoming::create($dataIncoming);
                    $message ='Your '.config('app.name').' has received some token. '.$amountToCredit.$asset.'
                    was successfully deposited into your account.';
                    $url = url('account/login');
                    $admin->notify(new AccountNotification($admin->name,$message,$url,'New Deposit of '.$amountToCredit.$asset));

                    $messages ='Your '.config('app.name').' has received some token.<br/> '.$amountToCredit.$asset.'
                    was successfully deposited into your account. The Fiat Equivalent has been reflected on your account.';
                    $url = url('account/login');
                    $user->notify(new AccountNotification($user->name,$messages,$url,'New Deposit of '.$amountToCredit.$asset));
                }
            }else{

                $this->addToSystemCharge($asset, $amountToSend);
                $dataIncoming =[
                    'asset'=>strtoupper($asset),
                    'addressFrom'=>$addressFrom,
                    'addressTo'=>$addressTo,
                    'accountId'=>$id,
                    'transHash'=>$txId,
                    'blockHeight'=>$blockHeight,
                    'blockHash'=>$blockHash,
                    'status'=>1,
                    'amount'=>$amountToCredit
                ];
                $systemAccount = SystemAccount::where('asset',strtoupper($coin->asset))->first();
                $dataSySBalance =[
                    'availableBalance'=>$systemAccount->availableBalance+$amountToCredit
                ];
                SystemIncoming::create($dataIncoming);
                SystemAccount::where('id',$systemAccount->id)->update($dataSySBalance);

                $message ='Your '.config('app.name').' has received some token. '.$amountToCredit.$asset.' was successfully deposited
                into your account.';
                $url = url('account/login');
                $admin->notify(new AccountNotification($admin->name,$message,$url,'New Deposit of '.$amountToCredit.$asset));
            }
        }
    }
    public function addToPendingClearance($coin,$request,$user,$wallet,$amount)
    {
        //get the account for the transfer
        $systemAccount = SystemAccount::where('asset',strtoupper($coin))->first();
        if (!empty($systemAccount)) {
            $dataClearance=[
                'amount'=>$amount,
                'asset'=>strtoupper($coin),
                'accountId'=>$request->input('accountId'),
                'addressTo'=>$systemAccount->address,
                'memoTo'=>$systemAccount->memo,
                'hasMemo'=>$systemAccount->hasMemo,
                'status'=>2,
                'user'=>$user,
                'derivatiionKey'=>$wallet->derivationKey
            ];
            $addPending = PendingClearance::create($dataClearance);
        }
    }
    public function addToSystemCharge($coin,$amount,$user)
    {
        //get the account to send charges
        $chargeWallet = ChargeWallet::where('asset',strtoupper($coin))->first();
        if (!empty($chargeWallet)) {
            $systemAccount = SystemAccount::where('asset',strtoupper($coin))->first();
            $coinExist = Coin::where('asset',strtoupper($coin))->first();
            $amountToSend = $amount;
            switch (strtoupper($coin)){
                case 'BTC':
                    $dataCharge = [
                        'asset'=>strtoupper($coin),
                        'amount'=>number_format($amountToSend,10),
                        'addressFrom'=>$systemAccount->address,
                        'addressTo'=>$chargeWallet->address,
                        'derivationKey'=>$systemAccount->derivationKey,
                        'hasMemo'=>$chargeWallet->hasMemo,
                        'memo'=>$chargeWallet->memo,
                        'accountId'=>$systemAccount->accountId
                    ];
                    break;
                case 'ETH':
                    $wallet = Wallet::where(['user'=>$user->id,'asset'=>$coin])->first();
                    $dataCharge = [
                        'asset'=>strtoupper($coin),
                        'amount'=>number_format($amountToSend,10),
                        'addressFrom'=>$wallet->address,
                        'addressTo'=>$chargeWallet->address,
                        'derivationKey'=>$wallet->derivationKey,
                        'hasMemo'=>$chargeWallet->hasMemo,
                        'memo'=>$chargeWallet->memo,
                        'accountId'=>$systemAccount->accountId
                    ];
                    break;
            }
            //collate data
            $dataCharge = [
                'asset'=>strtoupper($coin),
                'amount'=>number_format($amountToSend,10),
                'addressFrom'=>$systemAccount->address,
                'addressTo'=>$chargeWallet->address,
                'derivationKey'=>$systemAccount->derivationKey,
                'hasMemo'=>$chargeWallet->hasMemo,
                'memo'=>$chargeWallet->memo,
                'accountId'=>$systemAccount->accountId
            ];
            ChargeClearance::create($dataCharge);
        }
    }
}
