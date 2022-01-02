@props(['categoria'])

<article class="card flex flex-col shadow-sm ">

    <img class="h-32  w-full object-cover rounded-t" src="{{$categoria->image}}" alt="">

    <div class="card-body grid grid-cols-1 gap-2 place-content-start">

        <div class="flex flex-col justify-between items-baseline">

            <h1 class="w-full card-title text-xl font-bold text-gray-400 break-words">{{$categoria->name}}</h1>

            <p class="text-sm text-red-800">
                {{__('Fichas')}}: <small> ({{$categoria->fichas_count}})</small>
            </p>

        </div>

        @if ($categoria->description_eu)
        <p class="text-sm text-justify text-gray-500 italic">
            {{$categoria->description_eu}}
        </p>
        <hr>
        @endif

        <p class="text-sm text-justify text-gray-500">
            {{$categoria->description}}
        </p>



    </div>

    <div class="card-footer px-4 py-2">

        <a href="{{ route('fichas.list', $categoria->id) }}" class="btn btn-dark btn-block btn-rounded">
            {{__('Ver fichas')}}
        </a>

    </div>

</article>