<div class="bg-dark">
    <div class="max-w-screen-xl py-2 px-4 sm:px-6 text-gray-800 sm:flex justify-between mx-auto">
        @if(Auth::user()->hasAccess('platform.index'))
        <div class="p-5 sm:w-8/12">

         <h3 class="font-bold text-3xl text-indigo-600 mb-4">Accesos</h3>

         <div class="flex text-gray-300  text-sm">

           <a href="{{ route('platform.main') }}" class="mr-2 hover:text-indigo-600">Administración</a>

         </div>

        </div>

    </div>
    @endif
   <div class="flex py-5 m-auto text-gray-200 text-sm flex-col items-center border-t max-w-screen-xl">
       <p>SofTren© Copyright 2021. Todos los derechos reservados.</p>
    </div>
 </div>


