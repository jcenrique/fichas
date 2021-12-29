<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}" data-controller="html-load">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
        - {{ config('app.name') }}
        @endif
    </title>
    <meta name="csrf_token" content="{{  csrf_token() }}" id="csrf_token">
    <meta name="auth" content="{{  Auth::check() }}" id="auth">

    @if(file_exists(public_path('/css/orchid/orchid.css')))
    <link rel="stylesheet" type="text/css" href="{{  mix('/css/orchid/orchid.css') }}">
    @else
    <link rel="stylesheet" type="text/css" href="{{  orchid_mix('/css/orchid.css','orchid') }}">
    @endif
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />


    @stack('head')

    <meta name="turbo-root" content="{{  Dashboard::prefix() }}">
    <meta name="dashboard-prefix" content="{{  Dashboard::prefix() }}">

    @if(!config('platform.turbo.cache', false))
    <meta name="turbo-cache-control" content="no-cache">
    @endif

    <script src="{{ orchid_mix('/js/manifest.js','orchid') }}" type="text/javascript"></script>
    <script src="{{ orchid_mix('/js/vendor.js','orchid') }}" type="text/javascript"></script>
    <script src="{{ orchid_mix('/js/orchid.js','orchid') }}" type="text/javascript"></script>


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <!-- The "defer" attribute is important to make sure Alpine waits for Livewire to load first. -->

    @foreach(Dashboard::getResource('stylesheets') as $stylesheet)
    <link rel="stylesheet" href="{{  $stylesheet }}">
    @endforeach
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}"></script>


    @stack('stylesheets')

    @foreach(Dashboard::getResource('scripts') as $scripts)
    <script src="{{  $scripts }}" defer type="text/javascript"></script>
    @endforeach
</head>

<body class="h-auto bg-gray-400">
   
    <nav x-data="{open : false}" class="bg-dark">            
        <div class="px-2 sm:px-4">            
            <div class="flex items-center justify-between h-14">
                <x-orchid-icon path="fa.logoETS" width="4em" height="4em"  />
                <button @click="open = !open" class="md:hidden w-8 h-8 bg-red-900 text-gray-300 p-1 rounded-md focus:outline-none">
                    <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z">
                        </path>
                    </svg>
                </button>                  
                <div class="hidden md:block space-x-2">
                    <x-item title="{{__('Inicio')}}" active="{{request()->routeIs('home')}}" href="{{route('home')}}"/>
                    <x-item title="{{__('Fichas')}}" active="{{request()->routeIs('fichas.list')}}" href="{{route('fichas.list')}}"/>
                    <x-item title="{{__('Admin')}}"  href="{{route('platform.fichas.list')}}" hidden="{{Auth::user()->getRoles()->contains('slug', 'admin')? '':'hidden'}}"/>
                    <x-item title="{{__('Perfil')}}" href="{{route('platform.profile')}}" hidden="{{!Auth::user()->getRoles()->contains('slug', 'admin')? '':'hidden'}}"/>
                    <a href="{{ route('platform.logout') }}"
                    class="hover:bg-gray-400 rounded-lg p-2"
                    data-controller="form"
                    data-action="form#submitByForm"
                    data-form-id="logout-form"
                    dusk="logout-button">
                   
                    <span>{{ __('Sign out') }}</span>
                </a>
                <form id="logout-form"
                    class="hidden"
                    action="{{ route('platform.logout') }}"
                    method="POST"
                    data-controller="form"
                    data-action="form#submit"
                >
                    @csrf
                </form>
                </div>
                <div class="flex">
                    <div class="mr-4">
                        {{Auth::user()->name}}
                    </div>
                    <div class="mt-2">
                        <x-orchid-notification/>
                    </div>
                </div>
                
            </div> 
            
            {{-- movil device --}}
            <div :class="{'hidden' : !open}" @click.away="open = false" class="md:hidden bg-gray-900 p-1">
                <div class="px-2 pb-2 space-y-1">
                    <x-item title="{{__('Inicio')}}" active="{{request()->routeIs('home')}}" href="{{route('home')}}" block="true"/>
                    <x-item title="{{__('Fichas')}}" active="{{request()->routeIs('fichas.list')}}" href="{{route('fichas.list')}}" block="true"/>
                    <x-item title="{{__('Admin')}}"  href="{{route('platform.fichas.list')}}" block="true" hidden="{{Auth::user()->getRoles()->contains('slug', 'admin')? '':'hidden'}}"/>
                        <x-item title="{{__('Perfil')}}"  href="{{route('platform.profile')}}" block="true" hidden="{{!Auth::user()->getRoles()->contains('slug', 'admin')? '':'hidden'}}"/>
                    <a href="{{ route('platform.logout') }}"
                        class="hover:bg-gray-400 rounded-lg p-2 block"
                        data-controller="form"
                       
                        data-controller="form"
                        data-action="form#submitByForm"
                        data-form-id="logout-form"
                        dusk="logout-button">
                       

                        <span>{{ __('Sign out') }}</span>
                    </a>
                    <form id="logout-form"
                        class="hidden"
                        action="{{ route('platform.logout') }}"
                        method="POST"
                        data-controller="form"
                        data-action="form#submit"
                    >
                        @csrf
                    </form>
                </div>
            </div>
        </div>
       
    </nav>   
        
    

       


    <div class="container-fluid mt-2  w-11/12 md:w-9/12 p-1" data-controller="@yield('controller')"
        @yield('controller-data')>

        {{-- <div class="row "> --}}


            <div class="col overflow-hidden bg-gray-100 mb-2">
                <div class="d-flex flex-column-fluid">
                    <div class="container-md h-full px-0 px-md-5">
                        @yield('content')
                    </div>
                </div>
            </div>
            {{--
        </div> --}}



    </div>

    @stack('scripts')


</body>
@yield('footer')

</html>