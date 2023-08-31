<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Kutia\Larafirebase\Messages\FirebaseMessage;
use Illuminate\Notifications\Messages\MailMessage;

class SendPushNotification extends Notification
{
    use Queueable;
    protected $title;
    protected $content;
    protected $fcmTokens;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title,$content,$fcmTokens)
    {
        $this->title = $title;
        $this->content = $content;
        $this->fcmTokens = $fcmTokens;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['firebase'];
    }

    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
            ->withTitle($this->title)
            ->withBody($this->content)
            ->withPriority('high')->asMessage($this->fcmTokens);
    }
}