<html>
<head>

    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
            - {{ config('app.name') }}
        @endif
    </title>

    <style>
       @page { margin: 180px 50px;  }
    #header { position: fixed; left: 0px; top: -165px; right: 0px;  }
    #content { left: 0px; top: 0px; right: 0px;padding-top: 10px }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 50px; border: 2px solid red}

    .page-break { page-break-after: always; }

    div{
            margin: 0px;
            padding: 4px;

        }



        table {
            border-collapse: collapse;
            border: 2px solid gray;
        }

        td    {
            padding: 3px;
        }
    </style>
</head>


<body>
    <div id="header">

        <table width = "100%">
        <tr>
            <td width="10%" rowspan=3  style=" border: 1px solid gray">

                <p style="margin: 0px;">
                    <span ><img width=110px height=61
                            src="{{ url('/img/LogotipoETS.png') }}"></span>
                </p>



            </td>

            <td  align="center"  rowspan="3"
            style="font-family:'Verdana',sans-serif; border: 1px solid gray">

                    <p style="color:blue;margin: 0px;">
                            <b><span>
                                CIRCULACION Y GESTION DEL SERVICIO
                            </span></b>
                    </p>
                    <p style="margin: 0px;" >
                            <b><span >AVISO Nº:  </span></b><b><span >{{$ficha->code}}</span></b>
                    </p>


            </td>

            <td colspan="2" align="center" style="font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;"  >

                    <p style="font-size:8.0pt;color:blue;margin: 0px;" ><b><span >{{Str::upper( $ficha->category->name)}}</span></b>
                    </p>
            </td>
        </tr>


        <tr>
            <td  width="10%" align="center"
            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                VERSIÓN
                            </span></b>
                    </p>


            </td>


            <td  width="10%" align="center"
            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                {{$ficha->audits_count}}
                            </span></b>
                    </p>


            </td>




        </tr>


        <tr>
            <td  width="10%" align="center"
            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                FECHA
                            </span></b>
                    </p>


            </td>

            <td  width="10%" align="center"
            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                {{$ficha->updated_at->format('d-m-Y')}}
                            </span></b>
                    </p>


            </td>

        </tr>


        <tr>

            <td  width="15%" align="center"
            style="font-size:8.0pt; border: 1px solid gray; height: 10px;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                TÍTULO
                            </span></b>
                    </p>


            </td>

            <td  width="85%" align="center" colspan=3
            style="font-family:'Verdana',sans-serif; border: 1px solid gray;height: 10px;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                {{$ficha->title}}
                            </span></b>
                    </p>


            </td>


        </tr>
        <tr >
            <td  width="15%" align="center"
            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray;height: 50px;">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                INSTALACIONES / DESCRIPCIÓN
                            </span></b>
                    </p>


            </td>

            <td  width="85%" align="center" colspan=3
            style="font-family:'Verdana',sans-serif; border: 1px solid gray">

                    <p style="color:gray;margin: 0px;">
                            <b><span>
                                {{$ficha->description}}
                            </span></b>
                    </p>


            </td>


        </tr>
    </table>

</div>

<div id="content" style="border: 2px solid gray; margin: 5px;">

        @foreach ($ficha->capitulos as $capitulo)


        <div  >


                        <p style="color:blue;margin: 2px; font-weight: bold; font-size: large;text-decoration: underline;">
                            {{$capitulo->title}}

                        </p>

                        <p   >

                            {!!$capitulo->body!!}


                        </p>




        </div>


        @endforeach


    </div>


<script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_script('
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $pdf->text(270, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
        ');
    }


</script>
</body>
</html>
