<?php

namespace App\Http\Controllers\Admin;

use App\Custom\GenerateUnique;
use App\Custom\Regular;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SystemAccount;
use App\Models\SystemIncoming;
use App\Models\Withdrawal;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Wallets extends Controller
{
    use GenerateUnique;
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'System Wallets',
            'siteName'=>$web->name,
            'wallets'=>SystemAccount::get()
        ];

        return view('admin.wallets',$dataView);
    }

    public function deposits($asset)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'System Wallet Deposits',
            'siteName'=>$web->name,
            'deposits'=>SystemIncoming::where('asset',$asset)->get()
        ];

        return view('admin.wallet_deposits',$dataView);
    }
    public function withdrawals($asset)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'System Wallet Withdrawal',
            'siteName'=>$web->name,
            'withdrawals'=>Withdrawal::where('user',$user->id)->where('asset',$asset)->where('isSystem',1)->get(),
            'balances'=>SystemAccount::get()
        ];

        return view('admin.wallet_withdrawals',$dataView);
    }

    public function doWithdrawal(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'amount'=>['bail','required','numeric'],
            'asset'=>['bail','required','alpha_dash'],
            'address'=>['bail','required','string'],
            'pin'=>['bail','required']
        ]);
        if ($validator->fails()){
            return back()->with('error',$validator->errors());
        }

        $input = $validator->validated();

        $coin = $input['asset'];
        $amount = $input['amount'];
        $systemAccount = SystemAccount::where('asset',strtoupper($coin))->first();
        //check for pin
        $hashed = Hash::check($input['pin'],$user->password);
        if (!$hashed){
            return back()->with('error','Unauthorized action.');
        }
        //check for balance
        if ($systemAccount->availableBalance < $input['amount']){
            return back()->with('error','Insufficient balance');
        }
        $ref = $this->generateId('withdrawals','reference',10);
        $rates = new Regular();
        $rate = $rates->getCryptoExchange($input['asset'],'USD');
        $fiatAmount = $amount*$rate;

        $dataBalance = [
            'availableBalance'=>$systemAccount->availableBalance - $input['amount']
        ];

        $data=[
            'user'=>$user->id,'reference'=>$ref,'fiatAmount'=>$fiatAmount,'asset'=>$input['asset'],
            'addressTo'=>$input['address'],'accountId'=>$systemAccount->accountId,
            'amount'=>$amount,'status'=>4,'isSystem'=>1
        ];
        $withdrawal = Withdrawal::create($data);
        if (!empty($withdrawal)){
            SystemAccount::where('id',$systemAccount->id)->update($dataBalance);

            $userMessage = "A new system withdrawal of <b>".$amount.$coin."</b> has been authorized on your account and sent
            sent to the wallet address <b>".$input['address']."</b>";
            //send mail to user
            //SendInvestmentNotification::dispatch($user,$userMessage,'New Withdrawal');
            $user->notify(new InvestmentMail($user,$userMessage,'New System Withdrawal'));

            return back()->with('success','Withdrawal processing.');
        }
    }
}
