<?php

namespace App\Orchid\Layouts\Fichas;

use Orchid\Screen\TD;
use App\Models\Category;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;

class CategoryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

    
        return [

            TD::make('name',__( 'Nombre'))
                ->cantHide(false)
               
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Category $category)
                {
                    return Link::make($category->name)
                                ->myTooltip(__('Editar Categoría'))
                                ->class('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 py-1')
                                ->route('platform.category.edit' ,$category);
                }),

            TD::make('code', __('Código')),

            
            TD::make('category.version', __('Versión')),

            TD::make('description', __('Descripción ES'))
                ->cantHide(false)
               
                // ->render(function (Category $category)
                // {
                //     return   Str::of($category->description)->limit(100, ' ...');
                // })

                ->render(function (Category $category)
                {
                    $categoria_title_eu = Str::of($category->description_eu)->limit(100, ' ...');
                      
                    $categoria_title_es = Str::of($category->description)->limit(100, ' ...');
                    
                    if ($category->description_eu) {
                        $categoria_title = $categoria_title_eu . '<br>' . $categoria_title_es;
                    }else{
                        $categoria_title = $categoria_title_es;
                    }
                    return ModalToggle::make($categoria_title )
                    ->myTooltip(__('Ver descripción completa'))
                    ->icon('fa.book')
                    ->modal('oneAsyncModal')
                    ->class('px-2 py-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 py-1')
                    ->modalTitle(__('Descripción'))
                    ->asyncParameters([
                        'category' => $category->id,
                    ]);
                    ;

                })

                

                
                ,
            TD::make('num', __('Indice')),

            TD::make(__('Num. Fichas'))
                ->cantHide(false)
                
                ->render(
                    function (Category $category)
                    {
                        return count($category->fichas);
                    }
                ),

            TD::make('image', __('Imagen'))
                ->cantHide(false)
               
                ->render(function (Category $category)
                {


                    return view('layouts.category_image', [

                        'image'    => $category->image,

                   ]);
                }

                ),

        ];
    }

    /**
     * Enable a hover state on table rows.
     *
     * @return bool
     */
    protected function hoverable(): bool
    {
        return true;
    }
}
