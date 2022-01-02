<div class="flex flex-col">
    <div class="text-xs">{{Illuminate\Support\Str::of($ficha->description)->limit(100, ' ...') }}</div>
    @if ($ficha->instalacion)
        <div class="h-auto flex text-sm text-indigo-500 mt-2">
            <x-orchid-icon path="fa.map-marker-alt" />
            <div class="ml-4 text-xs" >{{$ficha->instalacion}}</div>
        </div>
    @endif
    

</div>