@if (session()->has(\Orchid\Alert\Alert::SESSION_MESSAGE))
    <div class="alert alert-{{ session(\Orchid\Alert\Alert::SESSION_LEVEL) }} rounded shadow-sm mb-3 p-3 d-flex">
        {!! session(\Orchid\Alert\Alert::SESSION_MESSAGE) !!}

        @yield('flash_notification.sub_message')
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@empty(!$error)
    <div class="alert alert-danger " role="alert">
        <h2 class="text-xl text-gray-500"><strong>{{  $message }}</strong><h2>
        {{ __('Change a few things up and try submitting again.') }}
        <ul class="m-t-xs">
            {{-- @foreach ($errors->all() as $error) --}}
                {{-- <li>{{ $error->errorInfo->message() }}</li> --}}
            {{-- @endforeach --}}
        </ul>
    </div>
@endif
