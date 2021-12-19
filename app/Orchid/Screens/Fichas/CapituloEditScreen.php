<?php

namespace App\Orchid\Screens\Fichas;

use App\Http\Requests\CapituloRequest;
use App\Models\Capitulo;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CapituloEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Editar Capitulo';

    public  $capitulo;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Capitulo $capitulo): array
    {
      
     
            $this->exists= $capitulo->exists;
        if ($this->exists){
            $this->name= 'Editar capítulo';
        }

        return [
            'capitulo' =>$capitulo

        ];
        
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Actualizar')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [

            Layout::view('components.edit-capitulo')
        ];
    }

    public function createOrUpdate(Capitulo $capitulo, CapituloRequest $request)
    {

     

        $capitulo->fill($request->all())->save();

        Toast::info('Registro guardado con éxito');

        return redirect()->route('platform.ficha.edit',$capitulo->ficha->id);

    }
}
