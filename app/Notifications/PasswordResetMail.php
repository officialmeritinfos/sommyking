<?php

namespace App\Notifications;

use App\Custom\GenerateUnique;
use App\Defaults\Regular;
use App\Models\PasswordReset;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class PasswordResetMail extends Notification
{
    use Queueable;
    protected $user;
    use GenerateUnique;
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
        $verificationUrl = route('verifyReset',['email'=>$this->user->email,'hash'=>$token]);
        $data=[
            'email'=>$this->user->email,'token'=>$token,'expiration'=>strtotime('1 Hour',time())
        ];
        PasswordReset::create($data);
        return (new MailMessage)
            ->subject('Account Recovery Verification')
            ->greeting('Hello '.$this->user->name)
            ->line('.<br>Before resetting your password, we need you to authenticate this request')
            ->action('Authenticate Now',$verificationUrl)
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
