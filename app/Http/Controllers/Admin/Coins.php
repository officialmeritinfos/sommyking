<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Coins extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Supported Coins',
            'user'     =>  $user,
            'web'=>$web,
            'coins'=>Coin::get()
        ];

        return view('admin.coins',$dataView);
    }
    public function edit($id)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $coin = Coin::where('id',$id)->first();
        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'Edit Coin',
            'user'     =>  $user,
            'web'=>$web,
            'coin'=>$coin,
        ];

        return view('admin.coin_details',$dataView);
    }

    public function updateCoin(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'id'=>['required','numeric'],
            'name'=>['required','string'],
            'asset'=>['required','string'],
            'address'=>['nullable','string'],
            'status'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();


        $data = [
            'name'=>$input['name'],'asset'=>$input['asset'],'code'=>$input['asset'],
            'address'=>$input['address'],'status'=>$input['status'],
        ];

        Coin::where('id',$input['id'])->update($data);

        return back()->with('success','Coin Updated');
    }

    public function delete($id)
    {
        Coin::where('id',$id)->delete();
        return back()->with('success','Deleted');
    }
    public function create()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'New Coin',
            'user'     =>  $user,
            'web'=>$web,
            'returnTypes'=>ReturnType::get(),
        ];

        return view('admin.new_coin',$dataView);
    }
    public function newCoin(Request $request)
    {
        $web = GeneralSetting::where('id',1)->first();
        $user = Auth::user();
        $validator = Validator::make($request->input(),[
            'name'=>['required','string'],
            'asset'=>['required','string'],
            'address'=>['nullable','string'],
            'status'=>['required','numeric'],
        ]);

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();


        $data = [
            'name'=>$input['name'],'asset'=>$input['asset'],'code'=>$input['asset'],
            'address'=>$input['address'],'status'=>$input['status'],
        ];

        Coin::create($data);

        return back()->with('success','Coin added');
    }
}
