<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountLogin extends Notification
{
    use Queueable;
    public $name;
    public $ip;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name,$ip)
    {
        $this->name = $name;
        $this->ip = $ip;
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
        return (new MailMessage)
                    ->subject('Account Login')
                    ->greeting('Hello '.$this->name)
                    ->line('Your account on '.env('APP_NAME').' was currently accessed from an IP '.$this->ip.'.
                    If this was not you, reset your account details and log out on every devices.')
                    ->action('Dashboard', url('login'))
                    ->line('Thank you for using '.env('APP_NAME'));
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
