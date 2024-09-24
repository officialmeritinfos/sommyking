<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Notifications extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'System Notifications',
            'user'     =>  $user,
            'web'      =>  $web,
            'notifications'  =>  Notification::orderBy('id','desc')->get(),
            'users'     =>User::where('id',$user->id)->get()
        ];

        return view('admin.notifications',$dataView);
    }

    public function addNew(Request $request)
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();
        $validator = Validator::make($request->all(),[
            'subject'=>['required','string','max:200'],
            'content'=>['required'],
            'display'=>['required','numeric'],
            'user'=>['required','numeric'],
        ])->stopOnFirstFailure();

        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $input = $validator->validated();

        $notification = Notification::create([
            'subject'=>$input['subject'],
            'content'=>$input['content'],
            'showInDashboard'=>$input['display'],
            'user'=>$input['user'],
        ]);
        if (!empty($notification)){
            return back()->with('success','Notification created');
        }
        return back()->with('error','Something went wrong');
    }

    public function deleteNotification($id)
    {
        $notification = Notification::where('id',$id)->first();
        $notification->delete();

        return back()->with('success','Notification removed.');
    }
}
