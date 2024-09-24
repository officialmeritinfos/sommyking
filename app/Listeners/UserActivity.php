<?php

namespace App\Listeners;

use App\Events\AccountActivity;
use App\Models\UserActivitiy;
use App\Models\UserNotificationSettings;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserActivity
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
    public function handle(AccountActivity $event)
    {
        $user = $event->user;
        $data = $event->data;
        //check if the user has notification turned on
        $userNotify = UserNotificationSettings::where('user',$user->id)->first();
        //we will add this activity and then attempt to send mail
        if ($userNotify->account_activity == 1) {
            UserActivitiy::create($data);
        }
    }
}
