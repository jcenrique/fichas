@if($capitulo->audits_count > 1)
<div class="flex justify-between flex-wrap mb-2">
    
    <div class="w-auto text-left pl-4 text-xl font-bold ">{{$capitulo->title}}
        <div class="text-xs font-normal text-gray-400">
            {{__('Numero de cambios:')}} {{$capitulo->audits_count-1}}
        </div>
    </div>
    
</div>


<table class="table table-hover border-2">

    <thead>
        <tr>


            <th width="30%">{{__('Título modificado')}}</th>

            <th> {{__('Contenido modificado')}}</th>

        </tr>
    </thead>

    <body>


        @foreach ($capitulo->audits as $key => $cambio_capitulo)
       
        <tr>


            <td width="30%">

                @if ((isset($cambio_capitulo->getModified()['title']['old']) && isset($cambio_capitulo->getModified()['title']['new']))&&
                ($cambio_capitulo->getModified()['title']['old'] !=
                $cambio_capitulo->getModified()['title']['new']))

                <div class="mb-4 border-b-2">
                    <h2 class="font-bold text-blue-700">{{__('Título capitulo')}}</h2>
                    <div class="m-4">
                        <div class="text-sm text-gray-500 text-left underline mb-2">
                            {{__('Valor Anterior')}} 

                        </div>
                        <div class="text-gray-700  text-left pl-6  ">
                            {{$cambio_capitulo->getModified()['title']['old']}}
                        </div>
                        <div class="text-sm text-green-500 text-left underline mb-2">
                            {{__('Valor creado el')}}
                            {{$cambio_capitulo->created_at->format('d-M-Y')}}
                            {{__('por el usuario:')}} {{$cambio_capitulo->user->name}}
                        </div>
                        <div class="text-green-700  text-left pl-6 ">
                            {{$cambio_capitulo->getModified()['title']['new']}}
                        </div>
                    </div>

                    
                </div>

                @endif

                @if ((isset($cambio_capitulo->getModified()['body']['old']) && isset($cambio_capitulo->getModified()['body']['new']) )&&
                ($cambio_capitulo->getModified()['body']['old'] !=
                $cambio_capitulo->getModified()['body']['new']))
   
                <div class="mb-4 border-b-2">
                    <div class="flex justify-between flex-wrap border-b-2 h-auto pb-2">
                        <div class="text-xl font-bold text-blue-700">{{__('Contenido')}}</div>
                        {!! \Orchid\Screen\Actions\Button::make()

                            ->icon('trash')
                            ->class('btn btn-danger  self-center text-bold ')
                            ->confirm('Esta usted seguro de eliminar el registro seleccionado')
                            ->myTooltip('Borrar registro de cambios')
                            ->method('removeAuditCapitulo')
                            ->parameters([
                            
                            'audit_id' => $cambio_capitulo->id,
                            'ficha_id' => $capitulo->ficha->id])
    
    
                            !!}
                       
                    </div>
                   
                    <div class="m-4">
                        <div class="text-sm text-gray-500 text-left underline mb-2">
                            {{__('Valor Anterior')}}

                        </div>
                        <div class="text-gray-700  text-left pl-6 ">
                            {!!$cambio_capitulo->getModified()['body']['old']!!}
                        </div>
                        <div class="text-sm text-green-500 text-left underline mb-2">
                            {{__('Valor creado el')}}
                            {{$cambio_capitulo->created_at->format('d-M-Y')}}
                            {{__('por el usuario:')}} {{$cambio_capitulo->user->name}}
                        </div>
                        <div class="text-green-700  text-left pl-6 ">
                            {!! $cambio_capitulo->getModified()['body']['new']!!}
                        </div>
                    </div>
                    

                </div>







                @endif

               

            </td>

        </tr>
       
        @endforeach


    </body>

</table>

@endif
