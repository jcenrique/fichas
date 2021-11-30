<?php

namespace App\Orchid\Layouts\Fichas;

use App\Orchid\Layouts\Fichas\AuditCapituloTable ;
use Orchid\Screen\Layouts\Accordion;

class FichaAuditoriaAcordion extends Accordion
{
  

    public function __construct()
    {
       

        $this->layouts = [
            'Cambios en ficha' => [
                AuditFichaTable::class,
            ],

            'Cambios en capitulos' => [
                AuditCapituloTable::class,
            ],



        ];
    }

}