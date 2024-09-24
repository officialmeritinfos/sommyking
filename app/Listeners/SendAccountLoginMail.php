<?php

namespace App\Listeners;

use App\Custom\Regular;
use App\Events\LoginMail;
use App\Models\GeneralSetting;
use App\Models\Login;
use App\Models\UserNotificationSettings;
use App\Notifications\AccountLogin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccountLoginMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(LoginMail $event)
    {
        $generalSettings = GeneralSetting::find(1);
        $user = $event->user;
        $ip=$event->ip;
        //get the user's country
        $ipDetector = new Regular();
        $agents = $ipDetector->getUserCountry($ip);
        if ($agents->ok()) {
            $locations = $agents->json();
            $userLocation = $locations['city'].','.$locations['state_prov'].','.$locations['country_name'];
            $isp =$locations['isp'];
        }else{
            $userLocation = '';
            $isp = '';
        }
        $userIp = $ip;
        $dataLogin = [
            'user'=>$user->id,
            'loginIp'=>$userIp,
            'agent'=>$_SERVER['HTTP_USER_AGENT'],
            'location'=>$userLocation,
            'isp'=>$isp
        ];
        $userNotification = UserNotificationSettings::where('user',$user->id)->first();
        if ($user->emailVerified ==1){
            if($userNotification->login_notification == 1) {
                Login::create($dataLogin);
                //send notification for user
                $user->notify(new AccountLogin($user->name,$ip));
            }
        }
    }
}
