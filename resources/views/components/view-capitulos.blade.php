<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

<link href="{{ asset('css/ficha.css') }}" rel="stylesheet">
<fieldset class="mb-3" data-async>

    @empty(!$title)
    <div class="col p-0 px-3">
        <legend class="text-black">
            {{ $title }}
        </legend>
    </div>
    @endempty
  
    @if ($ficha->id)


    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        @if (!$ficha->status)
        <div class="align-self-end mb-2">
            
{!!
    \Orchid\Screen\Actions\Link::make('Añadir cápitulo')
  
    ->myTooltip('Añadir nuevo capitulo')

    ->class('btn btn-primary')
    ->icon('fa.plus')
    ->route('platform.ficha-capitulo.edit',['ficha' => $ficha])
    

    !!}

   
        </div>
        @endif


        @foreach ($ficha->capitulos as $capitulo)

        <article @if ($loop->first)
            x-data="{open: true}"
            class=" border-1 border-b-0 border-gray-300 rounded-t-lg overflow-hidden order-{{$capitulo->orden}}"
            @elseif($loop->last)
            x-data="{open: false}"
            class=" border-1 border-b-1 border-gray-300 rounded-b-lg overflow-hidden order-{{$capitulo->orden}}"
            @else
            x-data="{open: false}"
            class=" border-1 border-b-0 border-gray-300 order-{{$capitulo->orden}}"
            @endif
            >
            <i class="fa-header-1"></i>
            <header class="bg-gray-200 border-gray-300 px-4 py-2  bg-fondo">
                <div class="flex justify-between">
                    <div class="flex justify-between items-center ">
                        <i x-on:click="open=!open" x-show="open === true"
                            class="fa fa-chevron-circle-up cursor-pointer text-blue-500 mr-2" data-toggle="tooltip"
                            data-placement="top" title="Contraer!"></i>
                        <i x-on:click="open=!open" x-show="open === false"
                            class="fa fa-chevron-circle-down cursor-pointer  text-blue-500 mr-2" data-toggle="tooltip"
                            data-placement="top" title="Desplegar!"></i>
                        <h1 x-on:click="open=!open" class="font-bold text-lg cursor-pointer select-none text-gray-600 hover:text-blue-700">{{$capitulo->title}}</h1>


                    </div>
                    @if (!$ficha->status)
                    <div class=" flex justify-center pt-3">


                        {!!
                        \Orchid\Screen\Actions\Link::make()
                        //->canSee(!$this->withTrashed)
                        ->myTooltip('Editar capitulo')

                        ->class('btn btn-link text-green-500 self-center text-bold ')
                        ->icon('pencil')
                        ->route('platform.capitulo.edit', [ 'capitulo' => $capitulo->id])

                        !!}


                        {!! \Orchid\Screen\Actions\Button::make()

                        ->icon('trash')
                        ->class('btn btn-link text-red-500 self-center text-bold ')
                        ->confirm('Esta usted seguro de eliminar el registro seleccionado')
                        ->myTooltip('Borrar capítulo')
                        ->method('removeCapitulo')
                        ->parameters([
                        'ficha_id' => $ficha->id,
                        'capitulo_id' => $capitulo->id])


                        !!}

                        {{-- cambiar el orden de los cpaitulos --}}

                        {!! \Orchid\Screen\Actions\Button::make()

                        ->icon('sort-amount-asc')
                        ->class('btn btn-link text-indigo-500 self-center text-bold ')
                        ->canSee(!$capitulo->isLastInOrder())
                        ->myTooltip('Bajar orden capítulo')
                        ->method('menosCapitulo')
                        ->parameters([
                        'ficha_id' => $ficha->id,
                        'capitulo_id' => $capitulo->id])


                        !!}
                        {!! \Orchid\Screen\Actions\Button::make()

                        ->icon('sort-amount-desc')
                        ->class('btn btn-link text-indigo-500 self-center text-bold ')
                        ->canSee(!$capitulo->isFirstInOrder())
                        ->myTooltip('Subir orden capítulo')
                        ->method('masCapitulo')
                        ->parameters([
                        'ficha_id' => $ficha->id,
                        'capitulo_id' => $capitulo->id])


                        !!}

                    </div>
                    @endif

                </div>
            </header>


            <div class="border-t-1 bg-white py-2 px-4" x-show="open">
               

               
                {!!$capitulo->body!!}
              




            </div>






        </article>


        @endforeach


        @else
        <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column text-gray-600 text-center text-xl ">
            {{__('Cuando se cree la ficha se podran crear los capitulos')}}
        </div>

        @endif

</fieldset>