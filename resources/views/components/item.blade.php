@props([
    'href' => '#', 
    'title', 
    'block' => false, 
    'active' => false,
    'hidden' =>'',
])
<a 
    href="{{ $href }}" 
    class="@if($active) bg-gray-400 text-white @else text-gray-100 hover:bg-gray-400 @endif p-2  @if($block) block @endif rounded-md
    {{$hidden}} "

>
    {{ __($title) }}
</a>