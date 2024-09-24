<?php

namespace App\Listeners;

use App\Custom\GenerateUnique;
use App\Events\AccountRecoveryMail;
use App\Models\GeneralSetting;
use App\Models\PasswordReset as ModelsPasswordReset;
use App\Notifications\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAccountRecoveryMail
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
    public function handle(AccountRecoveryMail $event)
    {
        $token = $this->createUniqueRef('two_way', 'code');
        $user = $event->user;
        $generalSettings = GeneralSetting::find(1);
        $user->notify(new PasswordReset($user->name, $user->email, $token));
        ModelsPasswordReset::create([
            'token' => $token,
            'email' => $user->email,
            'codeExpires'=>strtotime($generalSettings->codeExpires,time()),
        ]);
    }
}
