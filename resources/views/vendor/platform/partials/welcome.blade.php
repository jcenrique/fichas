<div class="bg-white rounded-top shadow-sm mb-3 p-4">

    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    {{-- <textarea {{ $attributes }}>{{ $value ?? '' }}</textarea> --}}
    <textarea class="html" name="nombre"></textarea>
    <script>
        tinymce.init({
             selector:'textarea.html',
             width: 900,
             height: 300
         });
      </script>

</div>
