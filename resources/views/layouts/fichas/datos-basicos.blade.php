@php
use Orchid\Screen\Actions\Link;
use App\Models\User;

use App\Models\Role;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
@endphp

<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
{{-- {{dd($ficha)}} --}}



{!! Input::make()
 ->title(__('Usuario'))
        ->value($ficha->user->name)
        ->disabled(true)

!!}

{!! Input::make( )
    ->title(__('Título'))
        ->value($ficha->title)
        ->disabled(true)

!!}

  
{!! TextArea::make( )
    ->title(__('Descriptión'))
        ->value($ficha->description)
        ->disabled(true)

!!} 

{!! TextArea::make( )
    ->title(__('Instalación'))
        ->value($ficha->instalacion)
        ->disabled(true)

!!}

{!! Relation::make( )
    ->title(__('Roles'))
    ->fromModel(Role::class, 'name')
    ->multiple()
    ->title('Choose your ideas');
!!} 

<label  class="form-label">{{__('Roles')}}
            
</label>

<div class="flex mb-4">
@foreach ($ficha->roles as $rol)
 <div class="p-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 ">
    {{$rol->name}}
 </div>
@endforeach

</div>

<label  class="form-label">{{__('Archivos')}}
            
</label>

<div class="flex ">
{{-- {{dd($ficha)}}   --}}
@foreach ($ficha->attachment as $archivo)

{!!Link::make($archivo->original_name)
->target('blank')
    ->href('/storage/' . $archivo->path . $archivo->name. '.' . $archivo->extension)
    ->class('btn btn-link p-2 mr-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 ');
!!}

@endforeach

</div>


   
</div>