<?php

namespace App\Orchid\Screens\Fichas;

use App\Models\Ficha;
use App\Models\User;
use App\Notifications\FichaCreada;
use App\Orchid\Filters\CategoryFilter;

use App\Orchid\Layouts\Fichas\CategorySelection;
use App\Orchid\Layouts\Fichas\FichaListLayout;

use App\Orchid\Layouts\Fichas\VersionEditLayout;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;
use Orchid\Crud\Filters\WithTrashed;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;

use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FichaListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name ;

    public $description;
    private $withTrashed = false;
    public $ficha;

    public $permission = [
        'platform.fichas.fichas'
    ];

    public function __construct()
    {
        $this->name = __('Lista de fichas');
        $this->description = __('Fichas disponibles para visualizar');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Ficha $ficha): array
    {
        $this->exists = $ficha->exists;

        if ($this->exists) {
            $this->name = __('Editar ficha');
        }
        $fichas = Ficha::with('category', 'roles', 'capitulos')->filters()->filtersApply([CategoryFilter::class, WithTrashed::class])->paginate(10);
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
            Link::make(__('Crear nueva'))
                ->canSee(!$this->withTrashed)
                ->myTooltip(__('Crear un nueva Ficha'))
                ->class('btn btn-default btn-rounded')
                ->icon('fa.plus')
                ->route('platform.ficha.edit'),

            Button::make(__('Eliminar seleccionados'))
                ->canSee($this->withTrashed)
                ->method('deleteSelectTrash')
                ->confirm('<strong class="text-red-500">' . __('¿Desea eleminar los elementos seleccionados definitivamente?') . '</strong>')
                ->myTooltip(__('Elimina definitivamente los elementos seleccionados'))
                ->class('btn btn-default btn-rounded')
                ->icon('fa.trash'),

            Button::make(__('Restaurar seleccionados'))
                ->canSee($this->withTrashed)
                ->method('restoreSelectTrash')
                ->confirm(__('¿Desea restaurar los elementos seleccionados?'))
                ->parameters(['seleccion'])
                ->myTooltip(__('Restaura los elementos seleccionados'))
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

            Layout::modal('modalStatus', [
                VersionEditLayout::class,
            ])
                ->title(__('¿Desea cambiar el estado de la ficha?'))
                ->size(Modal::SIZE_SM)
                ->applyButton(__('Cambiar estado'))
                ->closeButton(__('Cancelar'))
                ->type('bg-blue-200')
                ->staticBackdrop()

                ->async('asyncGetData')


                ,


        ];
    }

    public function restoreSelectTrash(Request $request)
    {
        try {
            foreach ($request->fichas as $id) {
                $ficha = Ficha::onlyTrashed()->find($id);
                $ficha->restore();
            }

            Toast::info(__('Elementos recuperados con éxito'));
        } catch (\Exception $e) {
            report($e);
            Toast::error(__('Se ha producido un error.'));
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

            Toast::info(__('Elementos recuperados con éxito'));
        } catch (\Exception $e) {
            report($e);
            Toast::error(__('Se ha producido un error.'));
        }

        //  return redirect()->route('platform.fichas.list');
    }

    public function publicar($id, Request  $request)
    {
        $ficha = Ficha::find($id);


        if ($request->get('aceptar')) {
            $ficha->update([
            'status' =>  !$ficha->status,
            'version' => $ficha->version +1
        ]);
        } else {
            $ficha->update([
            'status' =>  !$ficha->status,
        ]);
        }


        if ($ficha->status) {
            $authorizedRoles = $ficha->roles->pluck('name');

            $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                return $query->whereIn('name', $authorizedRoles);
            })->get();


            $ficha = Ficha::with('category')->find($id);

            $notificacion = new FichaCreada(__('Fichas'), __('Se creado o modificado una ficha'), $ficha);



            Notification::send($users, $notificacion);
        }

        return redirect()->route('platform.fichas.list');
    }

    /**
 * @return array
 */
    public function asyncGetData($id): array
    {
        $ficha = Ficha::find($id);

        return [
        'id' => $id,
        'version' => $ficha->version,
        'status' => $ficha->status
    ];
    }
}
