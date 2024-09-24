<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
{
    use Queueable;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
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
        $url = route('login');
        return (new MailMessage)
                ->greeting('Hello '.$this->name)
                ->line('Welcome to '.env('APP_NAME').', your one stop crypto payment processing solution.
                I am Michael Erastus,the CEO of '.env('APP_NAME').'.')
                ->line('Building '.env('APP_NAME').', we envisioned an all inclusive payment processing solution
                for all kind of transaction while at same time ensuring maximum security and customer satisfaction.
                We want you to have the best experience while using our service, and if you should ever met any challenge
                contact our support right away.')
                ->action('Go to Dashboard', $url)
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
