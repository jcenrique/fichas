<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EmailSenderScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Pantalla de correos';
    public $description ='Envio de correos';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'subject' => date('F') . ' Campaña de noticias',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

            Button::make('Enviar mensaje')
                ->icon('paper-plane')
                ->method('sendMessage')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('subject')
                    ->title('Asunto')
                    ->required()
                    ->placeholder('Asunto del mensaje')
                    ->help('Introduzca el asunto del mensaje'),

                Relation::make('users.')
                    ->title('Destinatarios')
                    ->multiple()
                    ->required()
                    ->placeholder('Dirección de correo')
                    ->help('Introduzca los destinatarios a los que desea enviar un correo')
                    ->fromModel(User::class, 'name', 'email'),

                Quill::make('content')
                    ->title('Contenido')
                    ->required()
                    ->placeholder('Inserte aquí el contenido del mensaje')
                    ->help('Añade contenido al mensaje que quieres enviar'),

            ])

        ];
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|min:6|max:50',
            'users' => 'required',
            'content' => 'required|min:10'
        ]);

        Mail::html($request->get('content'), function ($message) use ($request) {
            $message->from('john@johndoe.com', 'John Doe');

            $message->subject($request->get('subject'));

            foreach ($request->get('users') as $email) {
                $message->to($email);
            }
        });

        Alert::info('Su correo se ha enviado correctamente');
    }
}
