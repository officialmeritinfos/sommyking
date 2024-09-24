<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Settings extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView = [
            'web'=>$web,
            'user'=>$user,
            'pageName'=>'Account Settings',
            'siteName'=>$web->name
        ];

        return view('admin.settings',$dataView);
    }

    public function processSetting(Request $request)
    {
        $user = Auth::user();

        $web = GeneralSetting::where('id',1)->first();

        $validated = Validator::make($request->all(),[
            'name'=>['required','string','max:150'],
            'phone'=>['required','string','max:100'],
            'dob'=>['required','date'],
            'country'=>['required','string'],
            'twoWay'=>['required','numeric']
        ]);

        if ($validated->fails()){
            return back()->with('errors',$validated->errors());
        }

        $input = $validated->validated();

        $dataUser = [
            'name'=>$input['name'],'dateOfBirth'=>$input['dob'],'phone'=>$input['phone'],
            'country'=>$input['country'],'twoWay'=>$input['twoWay']
        ];

        $updated = User::where('id',$user->id)->update($dataUser);

        if ($updated){
            return back()->with('success','Profile updated');
        }
        return back()->with('error','Something went wrong');
    }

    public function processPassword(Request $request)
    {
        $user = Auth::user();

        $web = GeneralSetting::where('id',1)->first();

        $validated = Validator::make($request->all(),[
            'old_password'=>['required','string'],
            'new_password'=>['required','string','confirmed'],
            'new_password_confirmation'=>['required','string'],
        ]);

        if ($validated->fails()){
            return back()->with('errors',$validated->errors());
        }

        $input = $validated->validated();

        $hashed = Hash::check($input['old_password'],$user->password);
        if (!$hashed){
            return back()->with('error','Old Password is wrong');
        }
        $dataUser = [
            'password'=>bcrypt($input['new_password'])
        ];

        $updated = User::where('id',$user->id)->update($dataUser);

        if ($updated){
            return back()->with('success','Password updated');
        }
        return back()->with('error','Something went wrong');
    }
}
