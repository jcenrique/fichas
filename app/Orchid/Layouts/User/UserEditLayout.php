<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
       $user = $this->query->get('user');

      // dd(is_null($user->domain));
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->readonly(isset($user->domain ))
                ->title(__('Name'))
                ->placeholder(__('Introduzca su nombre completo')),



            Input::make('user.email')
                ->type('email')
                ->required()
                ->readonly(isset($user->domain))
                ->title(__('Email'))
                ->placeholder(__('Introduzca un nombre de Email')),

            Select::make('user.locale')
                ->required()
                ->options([
                    'es' => __('Castellano'),
                    'eu' => __('Euskera'),

                ])
                ->title(__('Lenguaje'))
                ->help(__('Seleccione el lenguaje de la aplicación')),

        ];
    }
}
