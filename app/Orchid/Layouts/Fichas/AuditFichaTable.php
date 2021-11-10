<?php

namespace App\Orchid\Layouts\Fichas;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AuditFichaTable extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'ficha.audits';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {

        return [
            TD::make('code', 'Código')


                ->render(function ($audit) {


                    if ((isset($audit->old_values['code']) && isset($audit->new_values['code'])) &&  ($audit->old_values['code'] !=  $audit->new_values['code'])) {
                        return view('layouts.fichas.audit-values', ['old_value' => $audit->old_values['code'], 'new_value' => $audit->new_values['code'], 'audit' => $audit]);
                    } else {
                        return view('layouts.fichas.audit-values');
                    }
                    //return view('layouts.fichas.audit-values',['old_value' => $audit->old_values['title'] , 'new_value' => $audit->new_values['title']]);

                }),

            TD::make('title', 'Título')


                ->render(function ($audit) {

                    if ((isset($audit->old_values['title']) && isset($audit->new_values['title'])) &&  ($audit->old_values['title'] !=  $audit->new_values['title'])) {
                        return view('layouts.fichas.audit-values', ['old_value' => $audit->old_values['title'], 'new_value' => $audit->new_values['title'], 'audit' => $audit]);
                    } else {
                        return view('layouts.fichas.audit-values');
                    }
                    //return view('layouts.fichas.audit-values',['old_value' => $audit->old_values['title'] , 'new_value' => $audit->new_values['title']]);

                }),
            TD::make('description', 'Descripción')


                ->render(function ($audit) {
                    if ((isset($audit->old_values['description']) && isset($audit->new_values['description']))  &&  ($audit->old_values['description'] !=  $audit->new_values['description'])) {
                        return view('layouts.fichas.audit-values', ['old_value' => $audit->old_values['description'], 'new_value' => $audit->new_values['description'], 'audit' => $audit]);
                    } else {
                        return view('layouts.fichas.audit-values');
                    }
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
