@push('head')
    <meta name="robots" content="noindex" />
    <link
          href="{{ route('platform.resource', ['orchid', 'favicon.svg']) }}"
          sizes="any"
          type="image/svg+xml"
          id="favicon"
          rel="icon"
    >
@endpush

<div class="h2 fw-light d-flex align-items-center">
   {{-- <x-orchid-icon path="plus" width="1.2em" height="1.2em"/> --}}
   <x-orchid-icon path="fa.logoETS" width="3em" height="3em" />
    <p class="ms-3 my-0 d-none d-sm-block">
        Softren
        <small class="align-top opacity">{{__('Fichas')}}</small>
    </p>
</div>
