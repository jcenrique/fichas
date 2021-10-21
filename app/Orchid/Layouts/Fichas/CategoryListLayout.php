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
                ->width('20%')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Category $category)
                {
                    return Link::make($category->name)
                                ->myTooltip('Editar Categoría')
                                ->style('background-color: rgba(var(--bs-light-rgb),var(--bs-bg-opacity))!important;color:var(--bs-gray)')
                                ->route('platform.category.edit' ,$category);
                }),

            TD::make('code', 'Código'),

            TD::make('description', 'Descripción')
                ->cantHide(false)
                ->width('60%')
                // ->render(function (Category $category)
                // {
                //     return   Str::of($category->description)->limit(100, ' ...');
                // })

                ->render(function (Category $category)
                {
                    return ModalToggle::make(Str::of($category->description)->limit(100, ' ...'))
                    ->myTooltip('Ver descripción completa')
                    ->modal('oneAsyncModal')
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
                ->width('10%')
                ->render(
                    function (Category $category)
                    {
                        return count($category->fichas);
                    }
                ),

            TD::make('image', 'Imagen')
                ->cantHide(false)
                ->width('10%')
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
