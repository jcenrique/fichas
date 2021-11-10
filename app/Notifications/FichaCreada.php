<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;

class FichaCreada extends Notification
{
    use Queueable;

    private  $title;
    private $message;
    private $ficha;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title , $message , $ficha)
    {
        $this->title=$title;
        $this->message=$message;
        $this->ficha = $ficha;

    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , DashboardChannel::class];
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
                    ->line(__('Se ha creado una nueva ficha'))
                    ->action(__('Ver ficha'), url('/ficha/show/' . $this->ficha->id))
                    ->line(__('Gracias por usar la aplicación!'));
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

    public function toDashboard($notifiable)
{
    return (new DashboardMessage())
        ->title('Hello Word')
        ->message('New post!')
        ->action(url('/'));
}
}
