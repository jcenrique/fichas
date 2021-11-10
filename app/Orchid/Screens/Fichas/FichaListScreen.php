<?php

namespace App\Orchid\Screens\Fichas;

use App\Http\Requests\FichaRequest;
use App\Models\Ficha;
use App\Models\User;
use App\Notifications\FichaCreada;
use App\Orchid\Filters\CategoryFilter;
use App\Orchid\Filters\FichaTrashedFilter;
use App\Orchid\Layouts\Fichas\CategorySelection;
use App\Orchid\Layouts\Fichas\FichaListLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Orchid\Crud\Filters\WithTrashed;
use Orchid\Platform\Models\Role;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class FichaListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lista de fichas';

    public $description = 'Fichas disponibles para visualizar';
    private $withTrashed = false;

    public $permission = [
        'platform.fichas.fichas'
    ];


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Ficha $ficha): array
    {


        $this->exists = $ficha->exists;

        if ($this->exists) {
            $this->name = 'Editar ficha';
        }
        $fichas = Ficha::with('category')->filtersApply([CategoryFilter::class, WithTrashed::class])->filters()->defaultSort('category_id', 'asc')->paginate(10);
        $ficha->load('attachment');

        if (count($fichas) != 0) {
            $this->withTrashed = $fichas->first()->trashed();
        }



        return [
            'ficha' => $ficha,
            'fichas' => $fichas,
            'withTrashed' => $this->withTrashed,
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
            Link::make('Crear nueva')
            ->canSee(!$this->withTrashed)
                ->myTooltip('Crear un nueva Ficha')
                ->class('btn btn-default btn-rounded')
                ->icon('fa.plus')
                ->route('platform.ficha.edit'),

            Button::make('Eliminar seleccionados')
                ->canSee($this->withTrashed)
                ->method('deleteSelectTrash')
                ->confirm('
                <strong class="text-red-500">¿Desea eleminar los elementos seleccionados definitivamente?</strong>')
                ->myTooltip('Elimina definitivamente los elementos seleccionados')
                ->class('btn btn-default btn-rounded')
                ->icon('fa.trash'),

                Button::make('Restaurar seleccionados')
                ->canSee($this->withTrashed)
                ->method('restoreSelectTrash')
                ->confirm('¿Desea restaurar los elementos seleccionados?')
                ->parameters(['seleccion'])
                ->myTooltip('Restaura los elementos seleccionados')
                ->class('btn btn-default btn-rounded')
                ->icon('fa.trash-restore'),



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
            CategorySelection::class,

            FichaListLayout::class,


        ];
    }

    public function restoreSelectTrash(Request $request)
    {
        try {

            foreach ($request->fichas as $id) {
                $ficha = Ficha::onlyTrashed()->find($id);
               $ficha->restore();

            }

            Toast::info('Elementos recuperados con éxito');
        } catch (\Exception $e) {
            report($e);
            Toast::error('Se ha producido un error.');
        }

        return redirect()->route('platform.fichas.list');

    }
    public function deleteSelectTrash(Request $request)
    {
        try {

            foreach ($request->fichas as $id) {
                $ficha = Ficha::onlyTrashed()->find($id);
                $ficha->capitulos()->forceDelete();
               $ficha->forceDelete();

            }

            Toast::info('Elementos recuperados con éxito');
        } catch (\Exception $e) {
            report($e);
            Toast::error('Se ha producido un error.');
        }

      //  return redirect()->route('platform.fichas.list');

    }

    public function publicar(Ficha $ficha, Request  $request)
    {


          // $ficha->status= !$ficha->status;
           $ficha->update([
               'status' =>  !$ficha->status,
           ]);

           if($ficha->status){

            $notificacion = new FichaCreada('Fichas', 'Se creado o modificado una ficha' , $ficha);
            $user =User::find(1);
            $user->notify($notificacion);


           // $users = null;
           // Notification::send($users, $notificacion);

           }

           return redirect()->route('platform.fichas.list');
    }

}
