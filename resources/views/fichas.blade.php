

@extends('layouts.app')

@section('content')

    <section class="" >
        <div  class=" w-full h-full  bg-cover bg-center" style="background-image: url({{ $category ==null? asset('img/fondo_fichas.jpg'): $category->image }})">
       
       
            <div class=" grid grid-cols-1 content-between  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full pt-8">
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-gray-200 font-bold text-4xl">
                        {{ $category ==null?
                            ' Fichas explicativas procedimientos en los Puestos de Mando de ETS':
                                $category->name
                            }}


                    </h1>
                    <p class="text-gray-200 text-lg mt-2 mb-4">
                    {{ $category ==null?
                        ' Si estás buscando refrescar tus conocimientos, has llegado al lugar adecuado. Encuentra las fichas que te ayudarán en ese proceso':
                            $category->description
                        }}
                    </p>
                    <!-- component search -->
                    @if ($category ==null)
                    <div class="w-full md:w-3/4 lg:w-1/2">
                        @include('platform::partials.search')
                    </div>
                    @endif
                
        


                </div>
                <div class="w-full md:w-3/4 lg:w-1/2">
                    <h1 class="text-indigo-200 font-bold text-4xl mt-2 mb-4 ">
                        {{__('FICHAS')}}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-full mx-4  grid grid-cols-1  gap-x-3 gap-y-4 mt-4 mb-4 ">
        {!! $fichas->links('vendor.pagination.tailwind') !!}
    </div>  

    <div class="max-w-full mx-4  grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-3 gap-y-4 mt-4 mb-4 ">
    @php
        $i=0;
    @endphp
    @forelse ($fichas as $ficha )
        @php
            $i++;
        @endphp
        <x-ficha-card :ficha="$ficha" :category="$category" :i="$i" />

    @empty
        <div class="text-center col-span-3 text-gray-500 text-lg">
            {{__('No hay fichas disponibles en la sección')}}
        </div>
    @endforelse
   

</div>
<div class="max-w-full mx-4  grid grid-cols-1  gap-x-3 gap-y-4 mt-4 mb-4 ">
    {!! $fichas->links('vendor.pagination.tailwind') !!}
</div>   
@endsection



@section('footer')

    @include('layouts.partials.footer')
@endsection



