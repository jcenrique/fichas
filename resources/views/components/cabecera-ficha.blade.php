<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
<div class="flex">
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Código')}}
        </div>
        <div  class="font-black text-red-800">
            {{$ficha->code}}
        </div>

    </div>
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Categoría')}}
        </div>
        <div  class="font-black text-red-800">
            {{isset($ficha->category->name)? $ficha->category->name: ''}}
        </div>

    </div>
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Publicado')}}
        </div>
        <div  class="font-black text-red-800">
            {{$ficha->status?'SI':'NO' }}
        </div>

    </div>
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Autor')}}
        </div>
        <div  class="font-black text-red-800">
            {{isset($ficha->user->name)?$ficha->user->name :'' }}
        </div>

    </div>
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Capítulos')}}
        </div>
        <div  class="font-black text-red-800">
            {{$ficha->capitulos_count }}
        </div>

    </div>
    <div class="flex-auto">
        <div class="text-lg text-gray-400">
            {{__('Versión')}}
        </div>
        <div  class="font-black text-red-800">
            {{$ficha->audits_count}}
        </div>

    </div>
</div>


</div>
