<?php

namespace App\Orchid\Layouts\Fichas;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Layouts\Rows;

class VersionEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    public $ficha;

    public function __construct()
    {
        
    }
    protected function fields(): array
    {
        
        return [

            Label::make('etiqueta')
           // ->title(  )
           
                ->value($this->query['status'] ?__('La ficha pasará a borrador y se ocultará a los usuarios ') : __('La ficha se publicará y quedará visible a los usuarios'))
                ->class($this->query['status'] ? 'text-center p-4 inline-flex text-xs leading-5 font-semibold  bg-red-100 text-red-800 ' :
                                                'text-center p-4 inline-flex text-xs leading-5 font-semibold  bg-green-100 text-green-800'),
                                               
             
            CheckBox::make('aceptar')
                ->sendTrueOrFalse()
                ->canSee(!$this->query['status'] )
               // ->title(__('Cambiar versión'))
                ->placeholder(__('Cambiar versión, nueva versión: ') .  $this->query['version']+ 1)
                ->help(__('Al marcar la opción se cambiará el numero de versión.'))
        ];
    }
}
