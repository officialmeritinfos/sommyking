<?php

namespace App\Notifications;

use App\Custom\GenerateUnique;
use App\Models\GeneralSetting;
use App\Models\TwoWay;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTwoWayApi extends Notification
{
    use Queueable;
    public $user;
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
        $web= GeneralSetting::where('id',1)->first();
        $code = $this->createUniqueRef('two_way','code');
        $dataCode = [
            'user'=>$this->user->id,
            'code'=>bcrypt($code),
            'email'=>$this->user->email,
            'codeExpires'=>strtotime($web->codeExpires,time())
        ];
        TwoWay::create($dataCode);
        return (new MailMessage)
            ->subject('Login Authentication')
            ->greeting('Hello '.$this->user->name)
            ->line('There is a Login request on your '.env('APP_NAME').' account.
                However, there is a Two factor authentication on your account.  Use the code below to
                authenticate this request.')
            ->line($code)
            ->line('Code expires in '.$web->codeExpires)
            ->line('Do not share this code with anybody via mail, sms, or phone call. None of our
            staff will ever ask for it either. Be vigilant!')
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
