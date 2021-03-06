<div class="bg-white rounded-top shadow-sm mb-3 p-4">

  <label for="">
    {{__('Título')}}
    <sup class="text-danger">*</sup>
  </label>
  <input class="form-control uppercase mb-4" name="title" type="text" value="{{old('title')??$capitulo->title??''}}">


  <label for="">
    {{__('Contenido')}}
    <sup class="text-danger">*</sup>
  </label>
  <textarea class="html form-control" name="body">{{old('body')??$capitulo->body??''}}</textarea>

  {{-- <input type="hidden" name ="ficha_id" value="{{$ficha_id}}"> --}}
 
 <script>
  tinymce.init({
            selector:'textarea.html',
            language: 'es',
            skin: "oxide-dark",
            contextmenu: false,
            height: 500,
            menubar: false,
            statusbar:false,
            image_title: true,
            browser_spellcheck : true,
            
  /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            file_picker_types: 'image',
            plugins: [
              'advlist  lists link image charmap print preview anchor',
              'searchreplace visualblocks code ',
              'insertdatetime media table textcolor  code media fullscreen'
            ],
           
            toolbar: 'undo redo | formatselect | ' +
              'bold italic forecolor  backcolor | alignleft aligncenter ' +
              'alignright alignjustify | bullist numlist outdent indent  |  link image media|  ' +
              'removeformat fullscreen',

         
             /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
              var input = document.createElement('input');
              input.setAttribute('type', 'file');
              input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
              var file = this.files[0];

              var reader = new FileReader();
              reader.onload = function () {
                /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
              };
              reader.readAsDataURL(file);
      };

      input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
           


  });
  </script>


</div>
