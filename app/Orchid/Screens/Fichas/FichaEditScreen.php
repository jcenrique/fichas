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
use App\Notifications\FichaCreada;
use App\Orchid\Layouts\Fichas\AuditCapituloTable;
use App\Orchid\Layouts\Fichas\AuditFichaTable;
use App\Orchid\Layouts\Fichas\CodigoListener;
use App\Orchid\Layouts\Fichas\FichasEditLayout;
use App\Orchid\Layouts\Fichas\CapituloEditLayout;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Layouts\View;
use Orchid\Screen\Sight;
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
            $this->description = $ficha->title ;
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

            Button::make($this->ficha->status?'Poner en borrador':'Publicar')

                ->icon('pencil')
                ->method('publicarFicha')
               // ->parameters(['ficha' => $this->ficha])
                ->canSee($this->exists),

            Button::make('Crear ficha')

                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),
            Button::make('Actualizar')
                ->icon('note')
                ->method('createOrUpdate')
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
                    CodigoListener::class,
                ],
                'Datos básicos'      => [
                    FichasEditLayout::class,

                ],
                'Capitulos' =>  Layout::view('components.view-capitulos'),





                'Auditoría' => Layout::accordion([
                    'Cambios en ficha' => [
                        AuditFichaTable::class,
                    ],

                    'Cambios en capitulos' => [
                        AuditCapituloTable::class,
                    ],



                ]),


            ])->activeTab('Codificación')
            ,

            Layout::modal('oneAsyncModal', CapituloEditLayout::class)
                ->title('Nuevo Capítulo')
                ->size(Modal::SIZE_LG)
                ->async('asyncGetFicha'),




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



        //Ficha::disableAuditing();

        $fichaId = $ficha->id;
        $category_id =  $request->get('category_id');
        $old_category_id =  $request->get('old_category_id');
        $code_ficha = $request->get('codigo');
        $old_code_ficha = $request->get('old_codigo');

        $ficha = Ficha::updateOrCreate(
            ['id' => $fichaId],
            array_merge($request->get('ficha'), ['code' =>  $code_ficha, 'category_id' => $category_id])
        );

        $ficha->roles()->attach($request->get('ficha')['roles']);

        $ficha->attachment()->syncWithoutDetaching(
            $request->input('ficha.attachment', [])
        );
        // $notificacion = new TaskCompleted('Creado post', 'Se ha creado el nuevo post');
        //$user =User::find($ficha->author);
        // $user->notify($notificacion);
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

    public function publicarFicha(Ficha $ficha, FichaRequest $request)
    {

        $ficha->update([
            'status' =>  !$ficha->status,
        ]);

        if($ficha->status){

            $data = array('name'=>"Virat Gandhi");

            Mail::send(['text'=>'mail'], $data, function($message) {
                $message->to('jcenrique170@gmail.com', 'Tutorials Point')->subject
                   ('Laravel Basic Testing Mail');
                $message->from('jcenrique170@gmail.com','Virat Gandhi');
             });
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
            $category_name = Category::find($category_id)->num . '-' . date('y') . '-' . Category::find($category_id)->code;
        } else {
            $category_name = Category::find($category_id)->num . '-' . date('y') . '-' . Category::find($category_id)->code;
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

    /**
     * @param User    $user
     * @param Request $request
     */
    public function saveCapitulo($ficha_id, $capitulo_id = null, Request $request)
    {

        $ficha = Ficha::find($ficha_id);
        if ($request->capitulo['id'] != null) {
            Capitulo::find($request->capitulo['id'])->update([
                'title' => $request->capitulo['title'],
                'body' => $request->capitulo['body'],
            ]);
        } else {
            $ficha->capitulos()->create(

                array_merge($request->get('capitulo'), ['ficha_id' => $ficha_id])
            );
        }


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


}
