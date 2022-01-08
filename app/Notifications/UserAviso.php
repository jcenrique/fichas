<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserAviso extends Notification
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
        
        return (new MailMessage())
        ->subject(__('Usuario creado/modificado'))
        ->line($this->message)
        ->line($this->user->getRoles()->count()>0 ?__('Perfiles asignados: ') . $this->user->getRoles()->implode('name' , ' | '):'')
       
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
