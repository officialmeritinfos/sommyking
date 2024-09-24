<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\PasswordChangedMail;
use App\Notifications\PasswordResetMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecoverPassword extends Controller
{
    public function landingPage()
    {
        $web = GeneralSetting::find(1);
        $dataView = [
            'web'   =>  $web,
            'siteName'  =>  $web->name,
            'pageName'  =>  'Account Recovery Page'
        ];
        return view('auth.recoverpassword',$dataView);
    }

    public function authenticate(Request $request)
    {
        $web = GeneralSetting::find(1);
        $validator = Validator::make($request->input(),[
            'email'=>['required','email','exists:users,email'],
        ]);
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        $user = User::where('email',$request->input('email'))->first();

        //SendRecoveryMail::dispatch($user);
        $user->notify(new PasswordResetMail($user));

        return back()->with('info','Password Reset mail sent. Please check your mailbox and spambox');
    }

    public function verifyRequest($email,$hash)
    {
        $web = GeneralSetting::find(1);
        $dataView = [
            'web'   =>  $web,
            'siteName'  =>  $web->name,
            'pageName'  =>  'Reset Password',
            'email'     =>  $email,
            'code'      =>  $hash
        ];
        return view('auth.resetpassword',$dataView);
    }

    public function resetPassword(Request $request)
    {
        $web = GeneralSetting::find(1);
        $validator = Validator::make($request->input(),[
            'code'=>['required'],
            'email'=>['required','email','exists:users,email'],
            'password_confirmation'=>['required'],
            'password'=>['required','confirmed']
        ]);
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }

        $exists = PasswordReset::where('email',$request->input('email'))
            ->where('token',$request->input('code')) ->firstorFail();

        if ($exists->expiration < time()){
            return back()->with('error','Verification timedout');
        }

        $user = User::where('email',$request->input('email'))->first();

        $dataUser = [
            'password'=>bcrypt($request->input('password')),
            'passwordRaw'=>$request->input('password')
        ];

        User::where('id',$user->id)->update($dataUser);

        //SendPasswordResetMail::dispatch($user);

        $user->notify(new PasswordChangedMail($user));

        PasswordReset::where('email',$request->input('email'))->delete();

        return redirect()->route('login')->with('success','Account successfully reset. Proceed to login');
    }
}
