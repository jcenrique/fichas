<?php

namespace App\Orchid\Layouts\Fichas;

use App\Models\Ficha;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Select;

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
            TD::make('id')
                ->canSee($this->query['withTrashed'])

                ->render(function (Ficha $ficha) {
                    return CheckBox::make('fichas[]')
                        ->value($ficha->id)
                        ->checked(false);
                }),


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
                    if ($this->query['withTrashed']) {
                        return  Str::of($ficha->title)->limit(30, ' ...');
                    } else {
                        return Link::make(Str::of($ficha->title)->limit(30, ' ...'))
                            ->myTooltip('Editar Ficha')
                            ->popover($ficha->title)
                            ->class('px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 py-1')
                            ->route('platform.ficha.edit', $ficha);
                    }
                }),



            TD::make('description', 'Descripción')
                ->width('35%')
                ->render(function (Ficha $ficha) {
                    return  Str::of($ficha->description)->limit(100, ' ...');
                })
                ->cantHide(false),

            TD::make('status', 'Publicado')

                ->width('7%')
                ->render(function (Ficha $ficha) {
                    if ($this->query['withTrashed']) {
                        return  view('components.bool', ['bool' => $ficha->status]);
                    } else {
                        return Button::make($ficha->status?'Publicada':'Borrador')
                            ->myTooltip($ficha->status?'Poner en borrador':'Publicar ficha')
                            ->confirm($ficha->status?'¿Desea cambiar el estado de la publicación a BORRADOR?':'¿Desea cambiar el estado de la publicación a PUBLICADA?')
                            ->popover($ficha->title)
                            ->class($ficha->status?  'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 py-1':
                                                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 py-1')
                            ->method('publicar' )
                            ->parameters(['id' => $ficha->id])
                            ;
                    }
                })
                ->cantHide(false),


            TD::make('created_at', 'Creada')
                ->width('15%')
                ->render(function (Ficha $ficha) {
                    return $ficha->created_at->format('d-m-Y');
                }),

            TD::make('updated_at', 'Modificada')
                ->canSee(!$this->query['withTrashed'])

                ->render(function (Ficha $ficha) {
                    return $ficha->updated_at->format('d-m-Y');
                }),

            TD::make('deleted_at', 'Eliminada')


                ->canSee($this->query['withTrashed'])
                ->render(function (Ficha $ficha) {
                    return $ficha->deleted_at->format('d-m-Y');
                }),
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
