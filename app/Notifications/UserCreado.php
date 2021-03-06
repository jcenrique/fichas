<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreado extends Notification
{
    use Queueable;


   
    private $message;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $message, $user)
    {
        $this->message=$message ;
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
      
        return (new MailMessage() )
        ->subject(__('Nuevo usuario en el sistema'))
        ->line($this->message)
        ->line(__('Usuario') . ': ' . $this->user->name)
        ->line(__('Mail') . ': ' . $this->user->email)
        
        ->action(__('Asignar rol usuario'), route('platform.systems.users.edit',  $this->user))
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
}
