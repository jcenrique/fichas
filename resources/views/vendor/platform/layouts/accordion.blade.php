<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<div  id="accordion-{{$templateSlug}}" class="accordion mb-3">
    @foreach($manyForms as $name => $forms)
        <div x-data="{open: true}" class="accordion-heading @if ($loop->index) collapsed  @endif"
             id="heading-{{\Illuminate\Support\Str::slug($name)}}"
             data-bs-toggle="collapse"
             data-bs-target="#collapse-{{\Illuminate\Support\Str::slug($name)}}"
             aria-expanded="true"
             aria-controls="collapse-{{\Illuminate\Support\Str::slug($name)}}">
            <h6 x-on:click="open=!open" class="btn btn-link btn-group-justified pt-2 pb-2 mb-0 pe-0 ps-0 d-flex align-items-center">
                {{-- <x-orchid-icon path="arrow-right" class="small me-2"/> --}}
                <i @if (!$loop->index) x-show="open" @else  x-show="!open" @endif  class="fa fa-chevron-circle-up cursor-pointer text-blue-500 mr-2" data-toggle="tooltip" data-placement="top" title="Contraer!"></i>
                <i @if (!$loop->index) x-show="!open" @else  x-show="open" @endif class="fa fa-chevron-circle-down cursor-pointer  text-blue-500 mr-2" data-toggle="tooltip" data-placement="top" title="Desplegar!"></i>
                {!! $name !!}
            </h6>
        </div>

        <div id="collapse-{{\Illuminate\Support\Str::slug($name)}}"
             class="mt-2 collapse @if (!$loop->index) show @endif"
             aria-labelledby="heading-{{\Illuminate\Support\Str::slug($name)}}"
             data-bs-parent="#accordion-{{$templateSlug}}">
                @foreach($forms as $form)
                    {!! $form !!}
                @endforeach
        </div>
    @endforeach
</div>
