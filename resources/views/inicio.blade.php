

<section class="bg-cover" style="background-image: url({{ asset('img/fondo.jpg') }})">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-64 pt-8">
        <div class="w-full md:w-3/4 lg:w-1/2">
            <h1 class="text-white font-bold text-4xl">
                Fichas explicativas procedimientos en los Puestos de Mando de ETS

            </h1>
            <p class="text-white text-lg mt-2 mb-4">
                Si estás buscando refrescar tus conocimientos, has llegado al lugar adecuado. Encuentra las fichas que te ayudarán en ese proceso
            </p>

            <div class="w-8/12">
                @include('platform::partials.search')
            </div>



        </div>
    </div>
</section>
<div>

</div>


<div class="max-w-7xl mx-auto  grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 gap-y-4 mt-4 mb-4">

    @foreach ($categorias as $categoria )

        <x-category-card :categoria="$categoria"/>


    @endforeach


</div>


