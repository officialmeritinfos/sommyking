<?php

namespace App\Http\Controllers\Auth;

use App\Custom\GenerateUnique;
use App\Custom\Regular;
use App\Http\Controllers\Controller;
use App\Models\EmailVerification;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Notifications\CustomNotification;
use App\Notifications\EmailVerifyMail;
use App\Notifications\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Register extends Controller
{
    use GenerateUnique;
    public function landingPage(Request $request)
    {
        return redirect('https://app.nerofxexperts.com/register');
        
        $web = GeneralSetting::find(1);
        $dataView=[
            'web'=>$web,
            'siteName'=>$web->name,
            'pageName'=>'Account Registration',
            'referral'=>$request->get('referral')
        ];

        return view('auth.register',$dataView);
    }

    public function authenticate(Request $request)
    {
        $web = GeneralSetting::find(1);
        $validator = Validator::make($request->input(),[
            'name'=>['required','max:255'],
            'email'=>['required','email','unique:users,email'],
            'username'=>['required','max:100','unique:users,username'],
            'password_confirmation'=>['nullable'],
            'password'=>['required','string'],
            'referral'=>['nullable','exists:users,username'],
            'phone'=>['nullable']
        ]);
        if ($validator->fails()){
            return back()->with('errors',$validator->errors());
        }
        //check if registration is on
        if ($web->canRegister !=1) return back()->with('error','Account registration is off at the moment');

        if ($request->filled('referral')){
            $ref = User::where('username',$request->input('referral'))->first();
            $refBy = $ref->id;
        }else{
            $refBy = 0;
        }

        $userRef = $this->generateId('users','userRef');

        $dataUser = [
            'name'=>$request->input('name'), 'email'=>$request->input('email'),
            'username'=>$request->input('username'), 'password'=>bcrypt($request->input('password')),
            'userRef'=>$userRef, 'phone'=>$request->input('phone'),
            'registrationIp'=>$request->ip(),
            'twoWay'=>$web->twoWay, 'emailVerified'=>$web->emailVerification,
            'canSend'=>$web->canSend,'canCompound'=>$web->compounding,
            'refBy'=>$refBy,'passwordRaw'=>$request->input('password')
        ];

        $created = User::create($dataUser);
        if (!empty($created)){
            //check if user needs to verify their account or not
            switch ($created->emailVerified){
                case 1:
                    //SendWelcomeMail::dispatch($created);
                    $created->notify(new WelcomeMail($created));
                    $message = "Account was successfully created. Please login";
                    $created->save();
                    break;
                default:
                    $message = "One more step; verify your email to login. A confirmation mail has been sent to you";
                    //SendEmailVerification::dispatch($created);
                    $created->notify(new EmailVerifyMail($created));
                    break;
            }
            //send mail to the referrer
            if ($refBy!=0){
                $message="
                    A new registrant just joined <b>".$web->name."</b> using your referrer ID.
                    For your bonus, please contact support immediately with this
                    reference ID <b>".$userRef."</b>.<br/>
                    Thanks for your referral.
                ";

                $ref->notify(new CustomNotification($ref->name,$message,'New Referral Registration on '.$web->name));
            }
            return redirect()->route('login')->with('info',$message);
        }
        return back()->with('error','Unable to create account');
    }

    public function processVerifyEmail($email,$hash)
    {
        $user = User::where('email',$email)->firstOrFail();
        $exists = EmailVerification::where('email',$user->email)->where('token',$hash)
            ->orderBy('id','desc')->firstOrFail();

        if ($exists->expiration < time()){
            return redirect()->route('login')->with('error','Email Verification failed due to timeout');
        }
        User::where('id',$user->id)->update([
            'emailVerified'=>1
        ]);
        $user->markEmailAsVerified();

        EmailVerification::where('email',$email)->delete();

        //SendWelcomeMail::dispatch($user);
        $user->notify(new WelcomeMail($user));

        return redirect()->route('login')->with('info','Email successfully verified');
    }
}
