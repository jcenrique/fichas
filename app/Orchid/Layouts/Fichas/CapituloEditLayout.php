<?php

namespace App\Orchid\Layouts\Fichas;

use Orchid\Screen\Field;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;

use Orchid\Screen\Layouts\Rows;

class CapituloEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [

            Input::make('capitulo.id')
                ->type('hidden')
                ->required()
             ,

             Input::make('capitulo.title')
             ->title(__('Título'))
             ->class('form-control uppercase')
                ->required()
             ,
             Quill::make('capitulo.body')
             ->required()
                 ->title(__('Contenido')),


        ];
    }
}
