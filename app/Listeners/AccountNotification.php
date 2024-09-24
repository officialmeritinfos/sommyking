<?php

namespace App\Listeners;

use App\Events\SendNotification;
use App\Models\UserNotificationSettings;
use App\Notifications\AccountNotification as NotificationsAccountNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AccountNotification
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
    public function handle(SendNotification $event)
    {
        $user = $event->user;
        $subject = $event->subject;
        $message = $event->message;

        //check if user has notification enabled
        $userNotify = UserNotificationSettings::where('user',$user->id)->first();
        if ($userNotify->account_activity ==1) {
            $user->notify(new NotificationsAccountNotification($user->name,$message,url('login'),$subject));
        }
    }
}
