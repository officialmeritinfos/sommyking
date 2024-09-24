<?php

namespace App\Listeners;

use App\Custom\GenerateUnique;
use App\Models\GeneralSetting;
use App\Models\TwoWay;
use App\Notifications\SendTwoFactor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTwoFactorMail
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
    public function handle($event)
    {
        $token = $this->createUniqueRef('two_way', 'code');
        $user = $event->user;
        $generalSettings = GeneralSetting::find(1);
        $user->notify(new SendTwoFactor($user->name, $user->email, $token));
        TwoWay::create([
            'code' => $token,
            'email' => $user->email,
            'codeExpires'=>strtotime($generalSettings->codeExpires,time()),
            'user'=>$user->id
        ]);

    }
}
