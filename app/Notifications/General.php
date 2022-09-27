<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class General extends Notification
{   
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected  $details;
    public function __construct(array  $details)
    {   
        $this->details = $details;
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
        ->subject( $this->details['subject'])
        ->greeting($this->details['greetings'] )
        ->line($this->details['message'])
        ->attach($this->details['path']);
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