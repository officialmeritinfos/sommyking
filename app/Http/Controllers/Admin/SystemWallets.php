<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\SystemAccount;
use App\Models\SystemWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SystemWallets extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'System Wallets',
            'siteName'=>$web->name,
            'wallets'=>SystemWallet::get()
        ];

        return view('admin.system_wallets',$dataView);
    }

    public function delete($id)
    {
        $wallet = SystemWallet::where('id',$id)->first();
        if (empty($wallet)){
            return back()->with('error','Invalid wallet selected');
        }

        $wallet->delete();

        return back()->with('success','Wallet successfully deleted.');
    }

    public function addWallet(Request $request)
    {
        $validator = Validator::make($request->input(),[
            'name'=>['required','string'],
            'asset'=>['required','string'],
            'network'=>['nullable','string'],
            'address'=>['required','string'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();


        $data = [
            'coin'=>$input['name'],'asset'=>$input['asset'],'network'=>$input['network'],
            'address'=>$input['address'],'status'=>1
        ];

        SystemWallet::create($data);

        return back()->with('success','Wallet added');
    }
}
