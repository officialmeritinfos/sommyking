<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendInvestmentNotification;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\Withdrawal;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Withdrawals extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'withdrawals'=>Withdrawal::where('isSystem','!=',1)->get(),
            'pageName'=>'Withdrawal Lists',
            'siteName'=>$web->name
        ];

        return view('admin.withdrawals',$dataView);
    }

    public function cancel($id)
    {
        $withdrawal = Withdrawal::where('id',$id)->first();
        if (empty($withdrawal)){
            return back()->with('error','Not found');
        }

        $investor = User::where('id',$withdrawal->user)->first();

        $dataUser = [
            'profit'=>$investor->profit+$withdrawal->fiatAmount
        ];

        $dataWithdrawal = [
            'status'=>3
        ];

        $update = Withdrawal::where('id',$id)->update($dataWithdrawal);
        if ($update){

            User::where('id',$investor->id)->update($dataUser);

            $userMessage = "
                Your withdrawal request with reference Id <b>".$withdrawal->reference." </b>
                has been rejected and account refunded of the requested amount.
            ";
            //send mail to user
            //SendInvestmentNotification::dispatch($investor,$userMessage,'Withdrawal Rejected');
            $investor->notify(new InvestmentMail($investor,$userMessage,'Withdrawal Rejected'));

        }
        return back()->with('success','Withdrawal Cancelled');
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::where('id',$id)->first();
        if (empty($withdrawal)){
            return back()->with('error','Not found');
        }

        $investor = User::where('id',$withdrawal->user)->first();

        $dataUser = [
            'withdrawal'=>$investor->withdrawal+$withdrawal->fiatAmount
        ];

        $dataWithdrawal = [
            'status'=>1
        ];

        $update = Withdrawal::where('id',$id)->update($dataWithdrawal);
        if ($update){

            User::where('id',$investor->id)->update($dataUser);

            $userMessage = "
                Your withdrawal request of <b>$".$withdrawal->fiatAmount."</b>
                with reference Id <b>".$withdrawal->reference."</b> has been approved
                and sent to your <b>".$withdrawal->asset."</b> wallet <b>".$withdrawal->addressTo."</b>.<br/>

               <p>Thanks for investing with <b>".env('APP_NAME')."</b></p>
            ";
            //send mail to user
            //SendInvestmentNotification::dispatch($investor,$userMessage,'Withdrawal Approval');
            $investor->notify(new InvestmentMail($investor,$userMessage,'Withdrawal Approval'));

        }
        return back()->with('success','Withdrawal Approved');
    }
}
