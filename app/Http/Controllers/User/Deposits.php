<?php

namespace App\Http\Controllers\User;

use App\Custom\GenerateUnique;
use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Deposit;
use App\Models\GeneralSetting;
use App\Models\SystemWallet;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\DepositMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Deposits extends Controller
{
    use GenerateUnique;

    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'Deposits',
            'siteName'=>$web->name,
            'deposits'=>Deposit::where('user',$user->id)->get()
        ];

        return view('user.deposits',$dataView);
    }

    public function newDeposit()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'coins'=>Coin::where('status',1)->get(),
            'pageName'=>'New Deposit',
            'siteName'=>$web->name,
            'wallets'=>SystemWallet::where('status',1)->get()
        ];

        return view('user.new_deposit',$dataView);
    }
}
