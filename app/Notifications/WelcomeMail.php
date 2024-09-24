<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeMail extends Notification
{
    use Queueable;
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
        return (new MailMessage)
                    ->subject('Welcome to '.env('APP_NAME'))
                    ->greeting('Hello '.$this->user->name)
                    ->line('A warm welcome to you from the '.env('APP_NAME')." team.<br>
                        <p>We established ".env('APP_NAME')." in order to help individuals like you trade your
                        digital assets(cryptocurrency) without fear of fraud even when you are sleeping.
                        We empower investors to earn unlimitedly using our investment packages.</p>
                        <p>We’d love to hear what you think of ".env('APP_NAME')." and if there is anything
                        we can improve. If you have any questions, do not hesitate to contact us.<br>")
                    ->line('Thank you for using our application!');
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
