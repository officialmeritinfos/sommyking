<?php

namespace App\Http\Controllers\User;

use App\Custom\GenerateUnique;
use App\Custom\Regular;
use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\GeneralSetting;
use App\Models\SystemAccount;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Withdrawals extends Controller
{
    use GenerateUnique;
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'withdrawals'=>Withdrawal::where('user',$user->id)->get(),
            'pageName'=>'Withdrawal Lists',
            'siteName'=>$web->name
        ];

        return view('user.withdrawals',$dataView);
    }
    public function newWithdrawal()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'New Withdrawal',
            'siteName'=>$web->name,
            'coins'=>Coin::where('status',1)->get(),
        ];

        return view('user.new_withdrawal',$dataView);
    }

    public function processWithdrawal(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'amount'=>['required','numeric'],
            'asset'=>['required','alpha_dash'],
            'account'=>['required','numeric'],
            'wallet'=>['required','string']
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();
        $amount = str_replace(',','',$input['amount']);

        //check if the user has the amount in balance
        switch ($input['account']){
            case 1:
                $balance = $user->profit;
                $newBalance = [
                    'profit'=>$balance- $amount
                ];
                break;
            default:
                $balance = $user->refBal;
                $newBalance = [
                    'refBal'=>$balance- $amount
                ];
                break;
        }
        if ($balance < $amount){
            return back()->with('error','Insufficient balance in selected account.');
        }
        $ref = $this->generateId('withdrawals','reference',10);
        $wallet = SystemAccount::where('asset',strtoupper($input['asset']))->first();
        $rates = new Regular();
//        $rate = $rates->getCryptoExchange($input['asset'],'USD');
//        $cryptoAmount = $amount/$rate;

        $data=[
            'user'=>$user->id,'reference'=>$ref,'fiatAmount'=>$input['amount'],'asset'=>$input['asset'],
            'addressTo'=>$input['wallet'],
            'amount'=>$input['amount']
        ];

        $withdrawal = Withdrawal::create($data);
        if (!empty($withdrawal)){
            User::where('id',$user->id)->update($newBalance);

            //check if admin exists
            $admin = User::where('is_admin',1)->first();
            $userMessage = "
                Your new withdrawal request of $<b>".$input['amount']." </b>
                has been received and will be processed soonest. Your Withdrawal reference Id is <b>".$ref."</b>
            ";
            //send mail to user
            //SendInvestmentNotification::dispatch($user,$userMessage,'New Withdrawal');
            $user->notify(new InvestmentMail($user,$userMessage,'New Withdrawal'));
            //send mail to Admin
            if (!empty($admin)){
                $adminMessage = "
                    A new withdrawal request of $<b>".$input['amount']."</b>
                    has been submitted by the investor <b>".$user->name."</b> with reference <b>".$ref."</b>
                ";
                //SendInvestmentNotification::dispatch($admin,$adminMessage,'New Withdrawal Request');
                $admin->notify(new InvestmentMail($admin,$adminMessage,'New Withdrawal Request'));
            }
            return redirect()->route('withdrawal.index')
                ->with('success','Withdrawal processing.');
        }
        return back()->with('error','Something went wrong');
    }
    public function cancel($id)
    {
        $user = Auth::user();

        $withdrawal = Withdrawal::where(['user'=>$user->id,'id'=>$id])->first();
        if (empty($withdrawal)){
            return back()->with('error','Invalid Request');
        }
        $users = User::where('id',$user->id)->first();
        if ($withdrawal->status ==3){
            return back()->with('error','Withdrawal already cancelled');
        }
        if ($withdrawal->status ==1){
            return back()->with('error','Withdrawal already completed');
        }
        $dataWithdrawal =['status'=>3];
        $dataUser = [
            'profit'=>$users->profit+$withdrawal->fiatAmount
        ];

        if (Withdrawal::where('id',$id)->update($dataWithdrawal)){
            User::where('id',$user->id)->update($dataUser);
            return back()->with('success','Withdrawal cancelled');
        }
        return back()->with('success','Withdrawal cancelled');
    }
}
