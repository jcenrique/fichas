

@extends('layouts.app')

@section('content')

    <section class="bg-cover" style="background-image: url({{ $category ==null? asset('img/fondo.jpg'): $category->image }})">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-64 pt-8">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <h1 class="text-white font-bold text-4xl">
                    {{ $category ==null?
                        ' Fichas explicativas procedimientos en los Puestos de Mando de ETS':
                            $category->name
                        }}


                </h1>
                <p class="text-white text-lg mt-2 mb-4">
                {{ $category ==null?
                    ' Si estás buscando refrescar tus conocimientos, has llegado al lugar adecuado. Encuentra las fichas que te ayudarán en ese proceso':
                        $category->description
                    }}
                </p>
                <!-- component search -->



            </div>
        </div>
    </section>



    <div class="max-w-full mx-4  grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-4 mt-4 mb-4 ">
    @php
        $i=0;
    @endphp
    @foreach ($fichas as $ficha )
        @php
            $i++;
        @endphp
        <x-ficha-card :ficha="$ficha" :category="$category" :i="$i" />


    @endforeach


</div>
@endsection



@section('footer')

    @include('layouts.partials.footer')
@endsection



