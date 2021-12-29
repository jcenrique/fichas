<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
     <meta name="description" content="" />
     <meta name="author" content="" />

     <!-- Title -->
     <title>{{__('No dispone de acceso a esta pagina.')}}</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
</head>

<body class="bg-dark text-white py-5">
     <div class="container py-5">
          <div class="row">
               <div class="col-md-2 text-center">
                    <p><i class="fa fa-exclamation-triangle fa-5x"></i><br/>{{__('Código: 403')}}</p>
               </div>
               <div class="col-md-10">
                    <h3>{{__('OPPSSS!!!! Lo sentimos...')}}</h3>
                    <p>{{__('Lo sentimos, su acceso es denegado por razones de seguridad de nuestro servidor y también de nuestros datos sensibles.<br/>Regrese a la página anterior para continuar navegando.')}}</p>
                    <a class="btn btn-danger" href="{{  route('home') }}">{{__('Volver atras')}}</a>
               </div>
          </div>
     </div>

     <div id="footer" class="text-center">
        <a href="#" target="_blank" rel="noopener">
            {{ __('Versión actual') }} v{{\Orchid\Platform\Dashboard::VERSION}}
        </a>
     </div>
</body>

</html>
