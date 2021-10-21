<?php

namespace App\Orchid\Layouts\Fichas;

use App\Models\Ficha;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Support\Str;

class FichaListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'fichas';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('category_id', 'Categoría')
            ->width('15%')

                ->render(function (Ficha $ficha) {
                    return $ficha->category->name;
                }),
            TD::make('code', 'Codigo')
            ->width('10%'),

            TD::make('title', 'Titulo')

                ->cantHide(false)
                ->width('20%')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->cantHide(false)
                ->render(function (Ficha $ficha) {
                    return Link::make(Str::of($ficha->title)->limit(30, ' ...'))
                        ->myTooltip('Editar Ficha')
                        ->popover($ficha->title)
                        ->style('background-color: rgba(var(--bs-light-rgb),var(--bs-bg-opacity))!important;color:var(--bs-gray)')
                        ->route('platform.ficha.edit', $ficha);
                }),



            TD::make('description', 'Descripción')
            ->width('35%')
                ->render(function (Ficha $ficha) {
                    return  Str::of($ficha->description)->limit(100, ' ...');
                })
                ->cantHide(false),

            TD::make('created_at', 'Creada')
            ->width('10%')
                ->render(function (Ficha $ficha) {
                    return $ficha->created_at->format('d-m-Y');
                }),

            TD::make('updated_at', 'Modificada')
            ->width('10%')
                ->render(function (Ficha $ficha) {
                    return $ficha->updated_at->format('d-m-Y');
                }),
        ];
    }
}
