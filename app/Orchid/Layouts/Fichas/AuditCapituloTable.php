<?php

namespace App\Orchid\Layouts\Fichas;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AuditCapituloTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'ficha.capitulos';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {


        return [

            TD::make('title', 'Capitulos')
                ->width('650px')
                ->render(function ($capitulo) {

                    return  view('layouts.fichas.audit-detalle-capitulo',['capitulo'=> $capitulo]);

                }),




        ];
    }
}
