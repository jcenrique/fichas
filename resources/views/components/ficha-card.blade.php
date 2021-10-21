@props(['ficha','category', 'i' ])


<article class="h-auto  card flex flex-row items-stretch rounded">

    {{-- <img class="h-full w-44 object-cover opacity-50 col-span-1 rounded-l" src="{{$ficha->category->image==null?'':$ficha->category->image;}}" alt=""> --}}
    <img class="h-full w-32 object-cover opacity-50  rounded-l" src="https://loremflickr.com/320/240/software/all?random={{random_int(1, 100)}} alt="">

    <div class="card-body w-full flex flex-wrap  content-between ">

        <div class="flex flex-wrap justify-between items-baseline ">
            <div>
                <div class="text-sm text-red-800">  {{$category==null?$ficha->category->name :''}}</div>
                <h1 class="card-title text-xl font-bold text-gray-400">{{$ficha->title}} </h1>
                <div class="font-mono text-xl font-bold text-red-800">{{  $ficha->code  }}</div>


                <div class="text-sm text-justify text-gray-500 mt-4">
                    <div class="underline mb-2">Descripción:</div>
                    <div class="mb-4 text-base"> {{$ficha->description}}</div>
                </div>
            </div>




        </div>

        <div class="w-full flex flex-col  border-t-2">

            <div class="flex  justify-between text-gray-500 mb-2">
                <div class="">Capitulos: <small>  ({{count($ficha->capitulos)}})</small></div>
                <div class="">Versiones: <small>  ({{$ficha->audits_count}})</small></div>

            </div>


            <div class="grid my-2  mr-2 place-items-center ">
                <a href="{{ route('fichas.show', $ficha->id) }}" class="btn btn-dark btn-block btn-rounded  w-2/3 ">
                    {{__('Ver ficha')}}
                </a>
            </div>

        </div>





    </div>



</article>
