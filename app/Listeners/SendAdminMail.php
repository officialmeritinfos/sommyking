<?php

namespace App\Listeners;

use App\Events\AdminNotification;
use App\Models\User;
use App\Notifications\CustomNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAdminMail
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
    public function handle(AdminNotification $event)
    {
        $message = $event->message;
        $subject = $event->subject;
        $admin = User::where('is_admin',1)->first();
        if(!empty($admin)){
            $admin->notify(new CustomNotification($admin->name,$message,$subject));
        }
    }
}
