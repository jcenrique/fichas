<?php

namespace App\Orchid\Screens\Fichas;

use App\Models\Ficha;
use App\Models\Capitulo;
use App\Models\Category;
use Orchid\Screen\Screen;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Modal;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use App\Http\Requests\FichaRequest;
use App\Models\Role;
use App\Models\User;
use App\Notifications\FichaCreada;
use App\Orchid\Layouts\Fichas\CodigoListener;
use App\Orchid\Layouts\Fichas\FichasEditLayout;

use App\Orchid\Layouts\Fichas\FichaAuditoriaAcordion;
use App\Orchid\Layouts\Fichas\VersionEditLayout;

use Illuminate\Support\Facades\Notification;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;
use OwenIt\Auditing\Models\Audit;

class FichaEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Crear una nueva ficha';

    public $description = '';
    /**
     * Si existe el modelo o es nuevo
     *
     * @var bool
     */
    public $exists = false;

    public $publicar = false;

    public $ficha;

    public $title;
    public $status = 0;

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


        $this->ficha = $ficha;

        if ($this->exists) {
            $this->name = __('Editar ficha');
            $this->description = $ficha->title;
            $this->ficha->load('attachment');
            $this->status = $ficha->status;
        }

        return [

            'title' => '',
            'ficha' => $ficha,
            'category_id' => $ficha->category_id,
            'old_category_id' => $ficha->category_id,
            'codigo' => $ficha->code,
            'old_codigo' => $ficha->code,

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
            Link::make(__('Vista pantalla'))
            ->icon('magnifier')
            ->myTooltip(__('Muestra una vista prevía con el formato en pantalla'))
            ->route('fichas.show', [$this->ficha->id])
            ->target('_blank')

            ->canSee($this->exists && !$this->status),

            Link::make(__('Vista impresión'))
                ->icon('magnifier')
                ->myTooltip(__('Muestra una vista prevía de impresión'))
                ->route('fichas.fichaPDF', [$this->ficha->id])
                ->target('_blank')
                ->canSee($this->exists && !$this->status),

         
            Button::make(__('Poner en borrador'))
                ->icon('pencil')
                ->myTooltip(__('Poner en modo borrador la ficha actual'))
                ->method('publicarFicha')
                ->canSee($this->exists && $this->status),

            ModalToggle::make(__('Publicar'))
                ->modal('modalVersion')
                ->icon('pencil')
                ->myTooltip(__('Publica la ficha actual y queda disponible a todos a los usuarios'))
                ->method('publicarFicha')
                ->confirm(__('Antes de publicar debe guardar los cambios o se perderán, ¿desea continuar?'))
                ->canSee($this->exists && !$this->status)
                ->asyncParameters([$this->ficha->id]),

            Button::make(__('Crear ficha'))
                ->icon('plus')
                ->method('createOrUpdate')
                ->canSee((!$this->exists)),

            Button::make(__('Actualizar'))
                ->icon('note')
                ->method('createOrUpdate')
                ->disabled($this->ficha->status ? true : false)
                ->canSee($this->exists),

            Button::make(__('Eliminar'))
                ->icon('trash')
                ->method('remove')
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
            Layout::columns([
                Layout::view('components.cabecera-ficha', ['ficha' => $this->ficha])
            ]),

            Layout::tabs([

                __('Codificación') => [
                    $this->status == 0 ? CodigoListener::class : $layout = Layout::rows([
                        Input::make('ficha.category.name')
                            ->type('text')
                            ->readonly()
                            ->title(__('Categoría')),

                        Input::make('ficha.code')
                            ->type('text')
                            ->readonly()
                            ->title(__('Código')),
                    ]),
                ],


                __('Datos básicos')      => [

                    $this->status == 0 ? FichasEditLayout::class : Layout::view('layouts.fichas.datos-basicos', ['ficha' => $this->ficha])

                ],



                __('Capítulos') => Layout::view('components.view-capitulos', ['ficha' => $this->ficha]),



                __('Registro de cambios') => [

                    $this->exists ? FichaAuditoriaAcordion::class : Layout::view('layouts.fichas.audit-null')
                ],


            ])->activeTab(__('Codificación')),



            Layout::modal('modalVersion', VersionEditLayout::class)
                ->title(__('Cambiar versión'))
                ->size(Modal::SIZE_SM)
                ->async('asyncGetDataEdit')




        ];
    }


    /**
     * @param Post    $ficha
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Ficha $ficha, FichaRequest $request)
    {
        $fichaId = $ficha->id;


        $category_id =  $request->get('category_id');
        $old_category_id =  $request->get('old_category_id');
        $code_ficha = $request->get('codigo');
        $old_code_ficha = $request->get('old_codigo');



        if ($code_ficha == null) {
            return;
        }

        $ficha = Ficha::updateOrCreate(
            ['id' => $fichaId],
            array_merge($request->get('ficha'), ['code' =>  $code_ficha, 'category_id' => $category_id])
        );

        if ($fichaId == null) {
            $ficha->roles()->attach($request->get('ficha')['roles']);
        } else {
            $ficha->roles()->sync($request->get('ficha')['roles']);
        }

        $ficha->attachment()->syncWithoutDetaching(
            $request->input('ficha.attachment', [])
        );

        if (is_null($fichaId)) {
            //incrementar contador categoria
            $ficha->category()->increment('num');
            Toast::info(__('Registro creado con éxito'));
        } else {
            if ($code_ficha != $old_code_ficha || $category_id != $old_category_id) {
                $ficha->category()->increment('num');
            }
            Toast::info(__('Registro actualizado con éxito'));
        }

        if (!$ficha->status) {
            $role =  Role::where('name', 'admin')->first();
            $users = $role->getUsers();


            $ficha = Ficha::with('category')->find($ficha->id);
            $notificacion = new FichaCreada(__('Fichas'), __('Se ha creado o modificado una ficha, puede revisar la ficha antes de publicarla'), $ficha);


            Notification::send($users, $notificacion);
        }

        //  Ficha::enableAuditing();
        return redirect()->route('platform.ficha.edit', [$ficha->id]);
    }
    /**
     * @param Post    $ficha
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function publicarFicha(Ficha $ficha, Request $request)
    {
        $ficha->update([
            'status' =>  !$ficha->status,
        ]);


        if ($request->get('aceptar')) {
            $ficha->update([
                
                'version' => $ficha->version + 1
            ]);
        }
        if ($ficha->status) {
            $authorizedRoles = $ficha->roles->pluck('name');

            $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                return $query->whereIn('name', $authorizedRoles);
            })->get();

            $ficha = Ficha::with('category')->find($ficha->id);
            $notificacion = new FichaCreada(__('Fichas'), __('Se ha creado o modificado una ficha'), $ficha);


            Notification::send($users, $notificacion);
        }


        return redirect()->route('platform.ficha.edit', [$ficha->id]);
    }

    /**
     * @param Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Ficha $ficha)
    {
        try {
            $ficha->delete();
        } catch (\Illuminate\Database\QueryException $ex) {
            Alert::view('layouts.partials.alert', Color::DANGER(), [
                'error' => $ex,
                'message' => __('Eliminar Ficha')
            ]);
            //
            report($ex);
            return;
        }

        Toast::warning(__('Has eliminado correctamente la ficha.'));

        return redirect()->route('platform.fichas.list');
    }




    public function asyncCodigo($category_id = null, $old_category_id = null, $codigo = null, $old_codigo)
    {
        if ($old_category_id != null && $codigo != null &&  ($category_id == $old_category_id)) {
            $category_name = $old_codigo;
        } elseif ($old_category_id != null && ($category_id != $old_category_id)) {
            $category_name = Category::find($category_id)->num . '-'  . Category::find($category_id)->code;
        } else {
            $category_name = Category::find($category_id)->num . '-' . Category::find($category_id)->code;
        }

        return [
            'category_id' => $category_id,
            'old_category_id' => $old_category_id,
            'codigo' => $category_name,
            'old_codigo' => $old_codigo,




        ];
    }


    /**
     * @param User $user
     *
     * @return array
     */
    public function asyncGetFicha(Ficha $ficha, Capitulo $capitulo): array
    {
        return [
            'ficha' => $ficha,
            'capitulo' => $capitulo

        ];
    }
    public function asyncGetDataEdit($id): array
    {
        $ficha = Ficha::find($id);

        return [
            'id' => $id,
            'version' => $ficha->version,
            'status' => $ficha->status

        ];
    }

   
  
    /**
     * @param User    $user
     * @param Request $request
     */
    

    public function saveCapitulo($ficha_id, $capitulo_id = null, Request $request)
    {
        $ficha = Ficha::find($ficha_id);
        if ($request->capitulo['id'] != null) {
            $capitulo = Capitulo::find($request->capitulo['id'])->update([
                'title' => $request->capitulo['title'],
                'body' => $request->capitulo['body'],
            ]);
        } else {
            $capitulo = $ficha->capitulos()->create(
                array_merge($request->get('capitulo'), ['ficha_id' => $ficha_id])
            );
        }

        // $version = $capitulo->currentVersion();
        //  dd($version);
        // dd( array_merge($request->get('capitulo'), [ 'ficha_id' => $ficha_id, 'order' => $ficha->orderCapitulo()]));



        Toast::info(__('Capitulo was saved.'));

        return redirect()->route('platform.ficha.edit', [$ficha_id]);
    }



    public function removeCapitulo($ficha_id, $capitulo_id)
    {
        Capitulo::find($capitulo_id)->forceDelete();



        Toast::warning(__('Registro eliminado.'));

        return redirect()->route('platform.ficha.edit', [$ficha_id]);
    }
    public function menosCapitulo($ficha_id, $capitulo_id)
    {
        Capitulo::find($capitulo_id)->moveOrderDown();;

        return redirect()->route('platform.ficha.edit', [$ficha_id]);
    }

    public function masCapitulo($ficha_id, $capitulo_id)
    {
        Capitulo::find($capitulo_id)->moveOrderUp();

        return redirect()->route('platform.ficha.edit', [$ficha_id]);
    }

    public function removeAuditCapitulo($audit_id, $ficha_id, Request $request)
    {
        Audit::find($audit_id)->delete();




        Toast::warning(__('Registro eliminado.'));

        return redirect()->route('platform.ficha.edit', [$ficha_id]);
    }
}
