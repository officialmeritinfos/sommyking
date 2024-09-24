<?php

namespace App\Listeners;

use App\Custom\GenerateUnique;
use App\Events\UserCreated;
use App\Models\EmailVerifyToken;
use App\Models\GeneralSetting;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmailVerification
{
    use GenerateUnique;
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
    public function handle(UserCreated $event)
    {
        $token = $this->createUniqueRef('email_verify_tokens', 'token');
        $user = $event->user;
        $generalSettings = GeneralSetting::find(1);
        if ($user->emailVerified !=1 && $generalSettings->emailVerification!=1){
            $user->notify(new VerifyEmailNotification($user->name, $user->email, $token));
            EmailVerifyToken::create([
                'token' => $token,
                'email' => $user->email
            ]);
        }
    }
}
