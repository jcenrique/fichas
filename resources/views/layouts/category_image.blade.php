
    <div class="d-sm-flex flex-row flex-wrap align-items-center">

        @empty(!$image)
            <span class="thumb-xl avatar me-sm-3 ms-md-0 me-xl-3  d-md-inline-block">
              <img src="{{ $image }}" class="bg-light">
            </span>
        @endempty

    </div>

