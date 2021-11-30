<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;
use Orchid\Support\Color;

class FichaCreada extends Notification  //implements ShouldQueue
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
        $this->message=$message . " a";
        $this->ficha = $ficha;
        //$delay = now()->addMinutes(1);

        //$this->delay($delay);

    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DashboardChannel::class];
       // return ['mail' , DashboardChannel::class];
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
                    ->line($this->message)
                    ->line(__('Categoría') . ': ' . $this->ficha->category->name)
                    ->line(__('Código') . ': ' . $this->ficha->code)
                    ->line(__('Título') . ': ' . $this->ficha->title)
                    ->line(__('Descripción') . ': ' . $this->ficha->description)
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
        ->title('Actualizada o creada ficha')
        ->type(Color::SUCCESS())
        ->message($this->ficha->toJson())
        ->action(url('/ficha/show/' . $this->ficha->id));
}
}
