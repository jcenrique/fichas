<div class="bg-white rounded-top shadow-sm mb-3 p-4">

  <label for="">
    {{__('Título')}}
    <sup class="text-danger">*</sup>
  </label>
  <input class="form-control uppercase mb-4" name="title" type="text" value="{{$capitulo->title}}">



  <label for="">
    {{__('Contenido')}}
    <sup class="text-danger">*</sup>
  </label>
  <textarea class="html form-control" name="body">{{$capitulo->body}}</textarea>
 
 
 <script>
    tinymce.init({
            selector:'textarea.html',
            language: 'es',
            height: 500,
            menubar: false,
            plugins: [
              
            ],
            toolbar: 'undo redo | formatselect | ' +
              'bold italic backcolor | alignleft aligncenter ' +
              'alignright alignjustify | bullist numlist outdent indent |  ' +
              'removeformat',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
           
         });
  </script>

</div>