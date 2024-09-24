<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Mail;
use App\Models\User;
use App\Notifications\InvestmentMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Mails extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $user = Auth::user();

        $dataView =[
            'siteName' => $web->name,
            'pageName' => 'System Mails',
            'user'     =>  $user,
            'web'      =>  $web,
            'mails'  =>  Mail::orderBy('id','desc')->get(),
            'users'     => User::where('id','!=',$user->id)->where('status',1)->get()
        ];

        return view('admin.mails',$dataView);
    }

    public function sendNew(Request $request)
    {
        $emails = $request->post();

        $arr=[
            'Froala Editor',
            'Editor',
            'Powered by',
            'Powered',
            'by'
        ];
        $content = str_replace($arr,'',$request->post('content'));

        for ($i=0;$i<count($emails['user']);$i++){
            $email=$emails['user'][$i];
            $user = User::where('email',$email)->first();

            $user->notify(new InvestmentMail($user,$content,$request->post('subject')));
        }

        $dataMail=[
            'subject'=>$request->post('subject'),
            'content'=>$content
        ];
        Mail::create($dataMail);
        return back()->with('success','Mail sent');
    }
}
