<?php

namespace App\Orchid\Layouts\Fichas;

use App\Models\Category;
use App\Models\Ficha;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Listener;
use Orchid\Support\Facades\Layout;

class CodigoListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
       
        'category_id',
       
        'old_category_id',
        'codigo',
        'old_codigo',
       

    ];


    // protected $code_ficha ="";

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncCodigo';



    public function __construct()
    {
    }


    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        
        return [
            Layout::rows([


                Relation::make('category_id')
                ->fromModel(Category::class, 'name')
                
              //  ->applyScope('orden')
                ->chunk(20)
               
                ->required()
                ->empty()
                ->title(__('Seleccionar categoría')),
                 
               


                Input::make('old_category_id')
                    ->type('hidden')
                    ->readonly(),



                Input::make('codigo')
                    ->title(__('Codificación'))
                    ->required()
                    ->readonly(),

                Input::make('old_codigo')
                    ->type('hidden')
                    ->readonly(),





            ])
        ];
    }
}
