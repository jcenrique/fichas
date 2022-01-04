@props(['ficha','category', 'i' ])
<script src="{{ asset('js/admin/tailwind-random-color.min.js') }}" ></script>

<article class="h-auto  card grid grid-cols-3  rounded">

    {{-- <img class="h-full w-44 object-cover opacity-50 col-span-1 rounded-l" src="{{$ficha->category->image==null?'':$ficha->category->image;}}" alt=""> --}}
    {{-- <img class="h-full w-32 object-cover opacity-50  rounded-l" src="https://loremflickr.com/320/240/software/all?random={{random_int(1, 100)}} alt=""> --}}
    <div id="fondo-{{$ficha->id}}" class="h-full w-full   col-span-1 rounded-l  flex flex-col justify-center items-center " >
        <span class = "w-96 text-center  text-5xl transform -rotate-90 text-gray-100">{{$ficha->code}}</span>
    </div>
   
   
    <div class="card-body p-4 w-full flex flex-wrap  content-between col-span-2">

        <div class="flex flex-wrap justify-between items-baseline ">
            <div>
                <div class="text-sm text-red-800">  {{$category==null?$ficha->category->name :''}}</div>
                <h1 class="card-title text-xl font-bold text-gray-400 break-words">{{$ficha->title}} </h1>
                <div class="font-mono text-xl font-bold text-red-800">{{  $ficha->code  }}</div>


                <div class="text-sm text-justify text-gray-500 mt-4">
                    <div class="underline mb-2">{{__('Descripción')}}:</div>
                    <div class="mb-4 ml-1 text-base break-words"> {{$ficha->description}}</div>
                </div>
            </div>




        </div>

        <div class="w-full flex flex-col  border-t-2">

            <div class="flex gap-3 justify-between text-gray-500 mb-2">
                <div class="">{{__('Capitulos')}}: <small>  ({{$ficha->capitulos_count}})</small></div>
                <div class="">{{__('Versión')}}: <small>  ({{$ficha->version}})</small></div>

            </div>


            <div class="grid my-2  mr-2 place-items-center ">
                <a href="{{ route('fichas.show', $ficha->id) }}" class="btn btn-dark btn-block btn-rounded  w-2/3 ">
                    {{__('Ver ficha')}}
                </a>
            </div>

        </div>





    </div>



</article>

<script>
    
   
   

    var color = new TailwindColor(options_color).pick();
    var d = document.getElementById("fondo-{{$ficha->id}}");
d.className += color;

</script>