@if (isset($old_value) )



    <div>
        <div class="text-sm text-gray-500 text-left">
            Valor Anterior

        </div>
        <div class="text-gray-700  text-left pl-6 ">
            {{$old_value}}
        </div>
        <div class="text-sm text-green-500 text-left">
            Valor creado el
            {{$audit->created_at->format('d-M-Y')}}
            por el usuario: {{$audit->user->name}}
        </div>
        <div class="text-green-700  text-left pl-6 ">
            {{$new_value}}

        </div>

    </div>

@else
{{-- <div class="text-sm text-red-500 text-left">
    Sin cambios
</div> --}}
@endif
