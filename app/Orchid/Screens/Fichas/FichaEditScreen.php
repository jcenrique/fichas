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
use App\Models\User;
use App\Notifications\FichaCreada;
use App\Orchid\Layouts\Fichas\CodigoListener;
use App\Orchid\Layouts\Fichas\FichasEditLayout;

use App\Orchid\Layouts\Fichas\FichaAuditoriaAcordion;
use App\Orchid\Layouts\Fichas\VersionEditLayout;

use Illuminate\Support\Facades\Notification;
use Orchid\Screen\Actions\ModalToggle;

use Orchid\Support\Color;
use Orchid\Support\Facades\Alert;

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
            $this->name = 'Editar ficha';
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



            ModalToggle::make(__('Cambiar versión'))
                ->modal('modalVersion')
                ->icon('sort-numeric-asc')
                ->method('cambiarVersion')
                ->myTooltip(__('Cambia la versión de la ficha actual'))
                ->canSee($this->exists && !$this->status)
                ->popover($this->ficha->title),
                

            // ->method('cambiarVersion'),

            Button::make(__('Poner en borrador'))
                ->icon('pencil')
                ->myTooltip(__('Poner en modo borrador la ficha actual'))
                ->method('publicarFicha')
                ->canSee($this->exists && $this->status),

            Button::make(__('Publicar'))
                ->icon('pencil')
                ->myTooltip(__('Publica la ficha actual y queda disponible a todos a los usuarios'))
                ->method('publicarFicha')
                ->confirm(__('Antes de publicar debe guardar los cambios o se perderán, ¿desea continuar?'))
                ->canSee($this->exists && !$this->status),

            Button::make('Crear ficha')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee((!$this->exists)),

            Button::make('Actualizar')
                ->icon('note')
                ->method('createOrUpdate')
                ->disabled($this->ficha->status ? true : false)
                ->canSee($this->exists),

            Button::make('Eliminar')
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

                'Codificación' => [
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


                'Datos básicos'      => [

                    $this->status == 0 ? FichasEditLayout::class : Layout::view('layouts.fichas.datos-basicos', ['ficha' => $this->ficha])

                ],



                'Capitulos' => Layout::view('components.view-capitulos'),

                //'Capitulos1' => Layout::view('components.edit-capitulo',['capitulo' => $this->ficha->capitulos[0]]),

                'Auditoría' => [

                    $this->exists  ?  FichaAuditoriaAcordion::class : Layout::view('layouts.fichas.audit-null')
                ],


            ])->activeTab('Codificación'),

            // Layout::modal('oneAsyncModal', CapituloEditLayout::class)
            //     ->title('Nuevo Capítulo')
            //     ->size(Modal::SIZE_LG)
            //     ->async('asyncGetFicha'),

                // Layout::modal('oneAsyncModal',[
                //     Layout::view('components.edit-capitulo',['ficha' => $this->ficha])
                // ])
                // ->title('Nuevo Capítulo')
                // ->size(Modal::SIZE_LG)
                // ->async('asyncGetFicha'),

            Layout::modal('modalVersion', VersionEditLayout::class)
                ->title('Cambiar versión')
                ->size(Modal::SIZE_SM)
                ->async('cambiarVersion')
               


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
            Toast::info('Registro creado con éxito');
        } else {
            if ($code_ficha != $old_code_ficha || $category_id != $old_category_id)   $ficha->category()->increment('num');
            Toast::info('Registro actualizado con éxito');
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

        //comprobar cambio de version






        $ficha->update([
            'status' =>  !$ficha->status,
        ]);

        if ($ficha->status) {

            $authorizedRoles = $ficha->roles->pluck('name');

            $users = User::whereHas('roles', static function ($query) use ($authorizedRoles) {
                return $query->whereIn('name', $authorizedRoles);
            })->get();

            $ficha = Ficha::with('category')->find($ficha->id);
            $notificacion = new FichaCreada(__('Fichas'), __('Se creado o modificado una ficha'), $ficha);


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
                'message' => 'Eliminar Ficha'
            ]);
            //
            report($ex);
            return;
        }

        Toast::warning('Has eliminado correctamente la ficha.');

        return redirect()->route('platform.fichas.list');
    }



    public function asyncCodigo($category_id = null, $old_category_id = null, $codigo = null, $old_codigo)
    {


        if ($old_category_id != null && $codigo != null &&  ($category_id == $old_category_id)) {
            $category_name = $old_codigo;
        } else if ($old_category_id != null && ($category_id != $old_category_id)) {
            $category_name = Category::find($category_id)->num . '-'  . Category::find($category_id)->code;
        } else {
            $category_name = Category::find($category_id)->num . '-' . Category::find($category_id)->code;
        }

        return [
            'category_id' => $category_id,
            'old_category_id' => $old_category_id,
            'codigo' => $category_name,
            'old_codigo' => $old_codigo


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

    public function cambiarVersion(Ficha $ficha, Request $request)
    {

        $version = $request->get('ficha')['version'];
        $ficha->update([
            'version' =>  $version,
        ]);

        


        return redirect()->route('platform.ficha.edit', [$ficha->id]);
       
    }

    // public function asyncCambiarVersion(Ficha $ficha): array
    // {
       

    //     return [
    //         'ficha' => $ficha,


    //     ];
    //}

    /**
     * @param User    $user
     * @param Request $request
     */
    public function saveCapitulo($ficha_id, $capitulo_id = null, Request $request)
    {

         dd($request->all());
        $ficha = Ficha::find($ficha_id);

        if ($request->id != null) {
            $capitulo = Capitulo::find($request->id)->update([
                'title' => $request->title,
                'body' => $request->body,
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

    // public function saveCapitulo($ficha_id, $capitulo_id = null, Request $request)
    // {

    //     //dd($request->all());
    //     $ficha = Ficha::find($ficha_id);
    //     if ($request->capitulo['id'] != null) {
    //         $capitulo = Capitulo::find($request->capitulo['id'])->update([
    //             'title' => $request->capitulo['title'],
    //             'body' => $request->capitulo['body'],
    //         ]);
    //     } else {
    //         $capitulo = $ficha->capitulos()->create(

    //             array_merge($request->get('capitulo'), ['ficha_id' => $ficha_id])
    //         );
    //     }

    //     // $version = $capitulo->currentVersion();
    //     //  dd($version);
    //     // dd( array_merge($request->get('capitulo'), [ 'ficha_id' => $ficha_id, 'order' => $ficha->orderCapitulo()]));



    //     Toast::info(__('Capitulo was saved.'));

    //     return redirect()->route('platform.ficha.edit', [$ficha_id]);
    // }

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
}
