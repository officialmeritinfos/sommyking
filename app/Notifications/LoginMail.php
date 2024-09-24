<?php

namespace App\Notifications;

use App\Models\Login;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginMail extends Notification
{
    use Queueable;
    protected $user;
    protected $request;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$request)
    {
        $this->user = $user;
        $this->request = $request;
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
        $data=[ 'user'=>$this->user->id,'agent'=>$this->request->header('User-Agent'),
            'ip'=>$this->request->ip(),
        ];
        Login::create($data);
        $url = route('user.dashboard');
        return (new MailMessage)
            ->subject('Login Notification')
            ->greeting('Hey '.$this->user->name)
            ->line("Your account <b>".env('APP_NAME')."</b> has been accessed. If this login was not
            authorized by you, click the button below to reset your account details.<br>")
            ->line("<b>IP:</b> ".$this->request->ip()."<br>")
            ->line("<b>Time:</b> ".date('M d Y, h:i a')."<br>")
            ->line("<b>Type:</b> Login using Email and Password")
            ->action('Go To Dashboard',$url)
            ->line("Ignore if this was you.<b>");
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
