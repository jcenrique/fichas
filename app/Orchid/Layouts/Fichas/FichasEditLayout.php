<?php

namespace App\Orchid\Layouts\Fichas;


use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;

class FichasEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title = '';

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
   
        return [




                Select::make('ficha.user_id')
                    ->title('Autor')
                    ->disabled($this->query['ficha']->status ? true : false)
                    ->value(Auth::user())
                    ->required()
                    ->fromModel(User::class, 'name'),





            Input::make('ficha.title')
            ->disabled($this->query['ficha']->status ? true : false)
                ->title('Título')
                ->required()
               ->class('form-control uppercase')

                ->placeholder('Introducir el título')
                ->help('Especificar una descripción corta para el título de la ficha.'),



            TextArea::make('ficha.description')
                ->title('Description')
                ->disabled($this->query['ficha']->status ? true : false)
                ->required()
                ->rows(3)
                ->maxlength(200)
                ->placeholder('Breve descripción para vista previa'),

            Select::make('ficha.roles')
                ->fromModel(Role::class, 'name')
               
                ->disabled($this->query['ficha']->status ? true : false)
                ->multiple()
                ->required()
                ->title(__('Asignar roles a la ficha')),

               

            Upload::make('ficha.attachment')
               
                ->style('border-width: 10px 1px;')
                ->title('Todos los archivos'),

               
            
        ];
    }
}
