<?php

namespace App\Http\Controllers\User;

use App\Custom\Regular;
use App\Custom\Wallet;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Notification;
use App\Models\Staking as Investment;
use App\Models\Swap;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Dashboard extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'User Dashboard',
            'user'     =>  $user,
            'deposits'  => Investment::where('user',$user->id)->where('status',2)->sum('amount'),
            'withdrawals'=>Withdrawal::where('user',$user->id)->where('status',1)->get(),
            'pendingWithdrawal'=>Withdrawal::where('user',$user->id)->where('status','!=',1)->get(),
            'investments' => Investment::where('user',$user->id)->get(),
            'ongoingInvestments'=>Investment::where('user',$user->id)->where('status',4)->sum('amount'),
            'completedInvestments'=>Investment::where('user',$user->id)->where('status',1)->get(),
            'web'=>$web,
            'notifications'=>Notification::where('status',1)->where('showInDashboard','!=',2)->where('user',$user->id)->get()
        ];

        return view('user.dashboard',$dataView);
    }
    public function accounts()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $balance = Balance::where('user',$user->id)->get();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'User Balances',
            'user'     =>  $user,
            'balances' =>$balance,
            'swaps'    =>Swap::where('user',$user->id)->paginate(10),
            'web'=>$web
        ];
        return view('user.accounts',$dataView);
    }
    public function doSwap(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'amount'=>['bail','string','required'],
            'balanceFrom'=>['bail','alpha','required'],
            'balanceTo'=>['bail','alpha','required']
        ]);
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }

        $input = $validator->validated();

        $balance = Balance::where(['user'=>$user->id,'asset'=>$input['balanceFrom']])->first();
        $balanceTo = Balance::where(['user'=>$user->id,'asset'=>$input['balanceTo']])->first();

        if (empty($balance)){
            return back()->with('error','Invalid account selected for swapping');
        }
        $amount = str_replace(',','',$input['amount']);
        if ($amount > $balance->availableBalance){
            return back()->with('error','Insufficient Balance');
        }
        if ($input['balanceFrom'] == $input['balanceTo']){
            return back()->with('error','Swapping to same account is not allowed');
        }
        //lets do our rate conversion
        $rates = new Regular();
        switch ($balance->isUsd){
            case 1:
                $rate = $rates->getCryptoExchange($input['balanceTo'],'USD');
                $amountCredit = $amount/$rate;
                break;
            default:
                $rate = $rates->getCryptoExchange($input['balanceFrom'],'USD');
                $amountCredit = $amount*$rate;
        }
        $dataSwap = [
            'user'=>$user->id,'amount'=>$amount,'balanceFrom'=>$input['balanceFrom'],
            'balanceTo'=>$input['balanceTo'],'amountCredited'=>$amountCredit
        ];
        $dataBalanceFrom = [
            'availableBalance'=>$balance->availableBalance -$amount
        ];
        $dataBalanceTo = [
            'availableBalance'=>$balanceTo->availableBalance+$amountCredit
        ];

        $swap = Swap::create($dataSwap);
        if (!empty($swap)){
            Balance::where('id',$balance->id)->update($dataBalanceFrom);
            Balance::where('id',$balanceTo->id)->update($dataBalanceTo);

            return back()->with('success','Swapping completed');
        }
        return back()->with('error','Something went wrong');
    }
}
