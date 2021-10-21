

 var SizeStyle = Quill.import('attributors/style/size');

 var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['image', 'link'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
         // superscript/subscript
           // outdent/indent
                        // text direction

    // custom dropdown
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    [{ 'font': [] }],
    [{ 'align': [] }],
                                     // remove formatting button
  ];

document.addEventListener('orchid:quill', (event) => {
    // Object for registering plugins
    event.detail.quill.register("modules/imageResize",window.ImageResize.default);

    event.detail.quill.register(SizeStyle, true);

    // Parameter object for initialization
    event.detail.options.modules = {

            toolbar: toolbarOptions,

        imageResize: {
            modules: [ 'Resize', 'DisplaySize' ]
            // toolbarStyles : {
            //     backgroundColor : 'red' ,
            //     border : 'none' ,
            //     color : 'red', // otros estilos camelCase para mostrar el tamaño } , toolbarButtonStyles : { // ... } , toolbarButtonSvgStyles : { // ... } ,


            // }

        }
        }


});
