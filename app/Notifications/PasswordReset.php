<?php

namespace App\Notifications;

use App\Models\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;
    public $name;
    public $email;
    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$email,$token)
    {
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
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
        $web= GeneralSetting::where('id',1)->first();
        $url = route('complete-recover',[$this->email,sha1($this->token)]);
        return (new MailMessage)
            ->subject('Password Reset')
            ->greeting('Hello '.$this->name)
            ->line('There is a Password Request request on your '.env('APP_NAME').' account. Click the button below
                to authorize this request. Link expires in '.$web->codeExpires)
            ->action('Reset', $url)
            ->line('Do not share this link with anybody via mail, sms, or phone call. None of our staff will ever ask for it
                either. Be vigilant!')
            ->line('Thank you for choosing '.env('APP_NAME'));
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
