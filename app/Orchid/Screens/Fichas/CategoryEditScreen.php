<?php

namespace App\Orchid\Screens\Fichas;

use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CategoryEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Crear una nueva categoría';

    /**
     * Display header description
     *
     * @var string
     */
    public $description = 'Categorías disponibles para las fichas.';


    public $permission = [
        'platform.fichas.categories'
    ];

    /**
     * Si existe el modelo o es nuevo
     *
     * @var bool
     */
    public $exists =false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {

    //    abort_if($this->authorize('update', $category),401,'Operación no autorizada');
        $this->exists= $category->exists;
        if ($this->exists){
            $this->name= 'Editar categoría';

        }

        return [
            'category' =>$category

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

            Button::make('Crear categoría')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make('Actualizar')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Eliminar')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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


                Input::make('category.code')
                    ->title('Código')
                    ->class('form-control uppercase')
                    ->placeholder('Introducir el código')
                    ->required()
                    ->help('Prefijo que se incluirá para la identificación de la ficha'),

                Input::make('category.name')
                    ->title('Nombre')

                    ->placeholder('Introducir el nombre')
                    ->required()
                    ->help('Nombre que ayuda a la clasificación de las fichas'),



                TextArea::make('category.description')
                    ->title('Descripción')
                    ->rows(3)
                    ->required()
                    ->placeholder('Introducir una breve descripción de la categoría'),

                Cropper::make('category.image')
                    ->maxWidth(200)
                    ->title('Imagen descriptiva')
                    ->width(500)
                    ->height(200)

                    ->staticBackdrop(),


            ])
        ];
    }

    /**
     * createOrUpdate
     *
     * @param  mixed $category
     * @param  mixed $request
     * @return void
     */
    public function createOrUpdate(Category $category, Request $request)
    {



        $category->fill($request->get('category'))->save();

        Toast::info('Registro guardado con éxito');

        return redirect()->route('platform.categories.list');

    }

    /**
     * remove
     *
     * @param  mixed $category
     * @return void
     */
    public function remove(Category $category)
    {

        $category->delete();

        Toast::info('Registro eliminado con éxito');

        return redirect()->route('platform.categories.list');
    }
}
