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

            TD::make('name', 'Nombre')
                ->cantHide(false)
               
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Category $category)
                {
                    return Link::make($category->name)
                                ->myTooltip('Editar Categoría')
                                ->class('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 py-1')
                                ->route('platform.category.edit' ,$category);
                }),

            TD::make('code', 'Código'),

            
            TD::make('category.version', 'Versión'),

            TD::make('description', 'Descripción')
                ->cantHide(false)
               
                // ->render(function (Category $category)
                // {
                //     return   Str::of($category->description)->limit(100, ' ...');
                // })

                ->render(function (Category $category)
                {
                    return ModalToggle::make(Str::of($category->description)->limit(100, ' ...'))
                    ->myTooltip('Ver descripción completa')
                    ->modal('oneAsyncModal')
                    ->class('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 py-1')
                    ->modalTitle('Descripción')
                    ->asyncParameters([
                        'category' => $category->id,
                    ]);
                    ;

                })

                ,
            TD::make('num', 'Indice'),

            TD::make('Num. Fichas')
                ->cantHide(false)
                
                ->render(
                    function (Category $category)
                    {
                        return count($category->fichas);
                    }
                ),

            TD::make('image', 'Imagen')
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
