<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <style>
  header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            color: white;
            text-align: center;
            line-height: 30px;
        }
p.capitulo {
display: block;
font-size: 1.5em;
font-weight: bold;
margin: 30px;
text-decoration-line: underline;


}



    </style>

</head>
<body>
<header>
        <table style="height: 2cm" >
            <tr>
                <td rowspan=3  style=" border: 1px solid gray">

                    <p >
                        <span ><img width=107 height=61
                                src="{{ url('/img/LogotipoETS.png') }}"></span>
                    </p>



                </td>

                <td  width="600px" align="center"  rowspan="3"
                style="font-family:'Verdana',sans-serif; border: 1px solid gray">

                        <p style="color:blue">
                                <b><span>
                                    CIRCULACION Y GESTION DEL SERVICIO
                                </span></b>
                        </p>
                        <p >
                                <b><span >AVISO Nº:  </span></b><b><span >{{$ficha->code}}</span></b>
                        </p>


                </td>

                <td colspan="2" align="center"  style="font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;"  >

                        <p ><b><span >{{Str::upper( $ficha->category->name)}}</span></b>
                        </p>
                </td>
            </tr>


            <tr>
                <td  width="85px" align="center"
                style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                        <p>
                                <b><span>
                                    VERSIÓN
                                </span></b>
                        </p>


                </td>


                <td  width="85px" align="center"
                style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                        <p>
                                <b><span>
                                    {{$ficha->audits_count}}
                                </span></b>
                        </p>


                </td>




            </tr>


            <tr>
                <td  width="85px" align="center"
                style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                        <p>
                                <b><span>
                                    FECHA
                                </span></b>
                        </p>


                </td>

                <td  width="85px" align="center"
                style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                        <p>
                                <b><span>
                                    {{$ficha->updated_at->format('d-m-Y')}}
                                </span></b>
                        </p>


                </td>

            </tr>


            <tr>

                <td  width="120px" align="center"
                style="font-size:8.0pt; border: 1px solid gray">

                        <p>
                                <b><span>
                                    TÍTULO
                                </span></b>
                        </p>


                </td>

                <td  width="595px" align="center" colspan=3
                style="font-size:14.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray">

                        <p>
                                <b><span>
                                    {{$ficha->title}}
                                </span></b>
                        </p>


                </td>


            </tr>
            <tr >
                <td  width="120px" align="center"
                style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray">

                        <p>
                                <b><span>
                                    INSTALACIONES / DESCRIPCIÓN
                                </span></b>
                        </p>


                </td>

                <td  width="595px" align="center" colspan=3
                style="font-size:14.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray">

                        <p>
                                <b><span>
                                    {{$ficha->description}}
                                </span></b>
                        </p>


                </td>


            </tr>
        </table>

</header>


<main>



@foreach ($ficha->capitulos as $capitulo)


<div style =" border: 2px solid gray;" >


                <p  style="font-size:12.0pt;font-family:'Verdana',sans-serif;">
                    {{$capitulo->title}}

                </p>
                <br>
                <p>

                    {!!$capitulo->body!!}


                </p>





</div>



@endforeach


</main>
</body>
</html>
