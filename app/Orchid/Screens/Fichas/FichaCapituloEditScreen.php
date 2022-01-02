<?php

namespace App\Orchid\Screens\Fichas;

use App\Http\Requests\CapituloRequest;
use App\Models\Capitulo;
use App\Models\Ficha;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FichaCapituloEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Nuevo cápitulo';

    public $ficha;
    public $capitulo;
    /**
     * Query data.
     *
     * @return array
     */

    public function __construct()
    {
        $this->name = __('Nuevo cápitulo');
    }
    public function query(Ficha $ficha): array
    {
        $this->capitulo = new Capitulo();
        $this->ficha = $ficha;
        return [
            'capitulo' => $this->capitulo,
            'ficha' => $this->ficha
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
            Button::make(__('Nuevo capitulo'))
                ->icon('note')
                ->method('createOrUpdate')



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

    public function createOrUpdate(Ficha $ficha, Capitulo $capitulo, CapituloRequest $request)
    {
        $ficha->capitulos()->create([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'ficha_id' => $ficha->id
        ]);

        Toast::info(__('Registro guardado con éxito'));

        return redirect()->route('platform.ficha.edit', $ficha->id);
    }
}
