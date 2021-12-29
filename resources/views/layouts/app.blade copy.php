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
    {{-- menu principal --}}

    
        
    

        <nav class=" bg-dark px-2 sm:px-4 py-2.5  dark:bg-gray-800" id="headerMenuCollapse">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <x-orchid-icon path="fa.logoETS" width="3em" height="3em"  />
                @if (Route::has('login'))

                <div  class="w-full md:block md:w-auto">
                    <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                    @auth
                    
                    <li>
                        {!!
                            \Orchid\Screen\Actions\Link::make(__('Inicio'))
                            ->route('home')
                            ->class('block py-2 pr-4 pl-3 text-white 0  md:bg-transparent md:text-blue-700 md:p-0 dark:text-white')
                            ->canSee(!request()->routeIs('home'))
                        
                            !!}
                    </li>

                {{-- <li> --}}
                    {!!
                        \Orchid\Screen\Actions\Link::make(__('Fichas'))
                        ->route('fichas.list')
                        ->class('block py-2 pr-4 pl-3 text-whited md:bg-transparent md:text-blue-700 md:p-0 dark:text-white')
                        ->canSee(!request()->routeIs('fichas.list'))
                        
                        !!}
        
                </li>

                    
                    @if(Auth::user()->hasAccess('platform.index'))
                    <li>
                        {!!
                            \Orchid\Screen\Actions\Link::make(__('Admin'))
                            ->route('platform.main')
                            ->class('block py-2 pr-4 pl-3 text-white  md:bg-transparent  md:p-0 dark:text-white')
                        
                            !!}
                    </li>
                    

            
                    @endif




                    <li>
                        <a href="{{ route('platform.logout') }}"
                        class="block py-2 pr-4 pl-3 text-white  md:bg-transparent  md:p-0 dark:text-white" data-controller="form"
                        data-action="form#submitByForm" data-form-id="logout-form" dusk="logout-button">
                        {{--
                        <x-orchid-icon path="logout" class="me-2" /> --}}

                        <span>{{ __('Sign out') }}</span>
                        </a>
                        <form id="logout-form" class="hidden" action="{{ route('platform.logout') }}" method="POST"
                            data-controller="form" data-action="form#submit">
                            @csrf
                        </form>
                    </li>


                
                    {{-- <a href="{{ url('/admin') }}" class="text-sm text-gray-300 underline">{{__('Admin')}}</a> --}}





                    @else
                        <li>
                            <a href="{{ route('login') }}" class="block py-2 pr-4 pl-3 text-white  md:bg-transparent 00 md:p-0 dark:text-white">{{__('Log in')}}</a>
                        </li>

                

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="block py-2 pr-4 pl-3 text-white  md:bg-transparent  md:p-0 dark:text-white">{{__('Register')}}</a>
                            </li>
                        
                        @endif
                    @endauth

                    </ul>
                </div>
                @endif
            </div>

        </nav>
</header>

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