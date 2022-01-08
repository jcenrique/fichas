@extends('layouts.app')

@section('content')

<link href="{{ asset('css/ficha.css') }}" rel="stylesheet">

<section class="bg-gray-700 py-6 mb-12">
    <div class="container grid grid-cols-1 lg:grid-cols-2 gap-3">
        <figure>
            <img class="h-60 w-full object-cover"
                src="{{$ficha->category->image==null?'':$ficha->category->image;}}"" alt="">
            </figure>

            <div class=" text-white">
            <h1 class="text-4xl mb-4">{{$ficha->title}}</h1>
            <h2 class="text-2xl mb-4 text-gray-300">{{$ficha->description}}</h1>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <p class="mb-2"><i class="fas fa-chart-line text-yellow-400 mr-2"></i> {{__('Categoría')}}:
                            {{$ficha->category->name}}</p>
                        <p class="mb-2"><i class="fas fa-layer-group text-yellow-400 mr-2"></i>{{__('Capítulos')}}:
                            {{$ficha->capitulos_count}}</p>
                        <p class="mb-2"><i class="fas fa-code-branch text-yellow-400 mr-2"></i> {{__('Revisión:')}}
                            {{$ficha->version}}</p>
                    </div>
                    <div class="flex justify-end items-end">
                        <a href="{{ route('fichas.fichaPDF', $ficha->id) }}" class="btn btn-dark btn-block btn-rounded"
                            target="_blank">
                            {{__('Imprimir/Descargar')}}
                        </a>
                    </div>

                </div>


    </div>


</section>

<div class="container">


    <section class="mb-12">
        <div class="flex justify-between mb-2">
            <h1 class="font-bold text-3xl text-indigo-500">{{__('Contenido de la ficha')}}</h1>
            @if (Auth::user()->hasAccess('fichas.edit'))
            <div class="flex justify-end items-end">
                <a href="{{ route('platform.ficha.edit', $ficha) }}" class="btn btn-dark " target="_blank">
                    {{__('Modificar ficha')}}
                </a>
            </div>
            @endif

        </div>

        @foreach ($ficha->capitulos as $capitulo)
        <article @if ($loop->first)
            x-data="{open: true}"
            class=" border-1 border-b-0 border-gray-300 rounded-t-lg overflow-hidden"
            @elseif($loop->last)
            x-data="{open: false}"
            class=" border-1 border-b-1 border-gray-300 rounded-b-lg overflow-hidden"
            @else
            x-data="{open: false}"
            class=" border-1 border-b-0 border-gray-300"
            @endif


            >
            <header class=" border-gray-300 px-4 py-2 cursor-pointer bg-fondo">
                <div class="flex items-center ">
                    <i x-on:click="open=!open" x-show="open === true"
                        class="fa fa-chevron-circle-up cursor-pointer text-blue-500 mr-2" data-toggle="tooltip"
                        data-placement="top" title="Contraer!"></i>
                    <i x-on:click="open=!open" x-show="open === false"
                        class="fa fa-chevron-circle-down cursor-pointer  text-blue-500 mr-2" data-toggle="tooltip"
                        data-placement="top" title="Desplegar!"></i>
                    <h1 x-on:click="open=!open" class="font-bold text-lg select-none text-gray-600 hover:text-blue-700">
                        {{$capitulo->title}}</h1>


                </div>
            </header>
            <div class="border-t-1 bg-white py-4 px-4" x-show="open">
                {{-- <ul class="grid grid-cols-1 gap-2"> --}}

                    {!!$capitulo->body!!}

                    {{-- </ul> --}}

            </div>

        </article>

        @endforeach
    </section>

</div>
@endsection

@section('footer')

@include('layouts.partials.footer')
@endsection