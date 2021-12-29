<?php

namespace App\Orchid\Layouts\Fichas;

use App\Orchid\Layouts\Fichas\AuditCapituloTable ;
use Orchid\Screen\Layouts\Accordion;

class FichaAuditoriaAcordion extends Accordion
{
  

    public function __construct()
    {
       

        $this->layouts = [
            __('Cambios en ficha') => [
                AuditFichaTable::class,
            ],

            __('Cambios en capitulos') => [
                AuditCapituloTable::class,
            ],



        ];
    }

}