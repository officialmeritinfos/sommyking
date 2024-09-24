<?php

namespace App\Notifications;

use App\Custom\GenerateUnique;
use App\Defaults\Regular;
use App\Models\TwoFactor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class TwoFactorMail extends Notification
{
    use Queueable;
    use GenerateUnique;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $token = sha1(Str::random());
        //add this to the user verification record
        $verificationUrl = route('auth.twoFactor',['email'=>$this->user->email,'hash'=>$token]);
        $data=[
            'user'=>$this->user->id,'token'=>$token,'expiration'=>strtotime('1 Hour',time())
        ];
        TwoFactor::create($data);
        return (new MailMessage)
            ->subject('Login Authentication')
            ->greeting('Hey '.$this->user->name)
            ->line("It looks like someone tried to log into your ".env('APP_NAME')." account
                from a new location. If this is you, follow the link below to authorize logging in from
                this location on your account. If this isn't you, we suggest changing your password as
                soon as possible.")
            ->action('Verify Login',$verificationUrl)
            ->line('<br> The above link will expire in One Hour')
            ->line('.<br>Thank you for using '.env('APP_NAME'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
