<?php

namespace App\Orchid\Screens\Fichas;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
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
    public $exists = false;


    public function __construct()
    {
        $this->name = __('Crear una nueva categoría');
        $this->description = __('Categorías disponibles para las fichas.');
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category): array
    {

        //    abort_if($this->authorize('update', $category),401,'Operación no autorizada');
        $this->exists = $category->exists;
        if ($this->exists) {
            $this->name = __('Editar categoría');
        }

        return [
            'category' => $category

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

            Button::make(__('Crear categoría'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make(__('Actualizar'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make(__('Eliminar'))
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
                    ->title(__('Código'))
                    ->class('form-control uppercase')
                    ->placeholder(__('Introducir el código'))
                    ->required()
                    ->help(__('Prefijo que se incluirá para la identificación de la ficha')),

                Input::make('category.name')
                    ->title(__('Nombre'))

                    ->placeholder(__('Introducir el nombre'))
                    ->required()
                    ->help(__('Nombre que ayuda a la clasificación de las fichas')),

                TextArea::make('category.description')
                    ->title(__('Descripción Castellano'))
                    ->rows(3)
                    ->required()

                    ->placeholder(_('Introducir una breve descripción de la categoría en Castellano')),

                TextArea::make('category.description_eu')
                    ->title(__('Descripción Euskera'))
                    ->rows(3)


                    ->placeholder(_('Introducir una breve descripción de la categoría en Euskera')),

                Cropper::make('category.image')
                    //->maxWidth(200)
                    ->title(__('Imagen descriptiva'))
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
    public function createOrUpdate(Category $category, CategoryRequest $request)
    {
        $category->fill($request->get('category'))->save();

        Toast::info(__('Registro guardado con éxito'));

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
        try {
            $category->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            Alert::view('layouts.partials.alert', Color::DANGER(), [
                'error' => $ex,
                'message' => __('Eliminar categoría')
            ]);

            report($ex);
            return;
        }

        Toast::info(__('Registro eliminado con éxito'));

        return redirect()->route('platform.categories.list');
    }
}
