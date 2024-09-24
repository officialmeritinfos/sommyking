<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\Investment;
use App\Models\Staking;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Admin Dashboard',
            'user'     =>  $user,
            'deposits'  => Deposit::where('status',1)->get(),
            'withdrawals'=>Withdrawal::where('status',1)->get(),
            'pendingWithdrawal'=>Withdrawal::where('status','!=',1)->get(),
            'investments' => Staking::get(),
            'ongoingInvestments'=>Staking::where('status',4)->get(),
            'completedInvestments'=>Staking::where('status',1)->get(),
            'cancelledInvestments'=>Staking::where('status',3)->get(),
            'investors'=>User::where('id','!=', $user->id)->get()
        ];

        return view('admin.dashboard',$dataView);
    }
}
