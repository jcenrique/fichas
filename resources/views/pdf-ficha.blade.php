<html>

<head>

    <title>
        @yield('title', config('app.name'))
        @hasSection('title')
        - {{ config('app.name') }}
        @endif
    </title>

    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: white;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px red solid;
            height: 257mm;
            outline: 2cm #FFEAEA solid;
        }

        @page {
            size: A4;

            margin-top:1cm;

            margin-bottom: 1cm;

        }

        @media print {

            html,
            body {

                width: 210mm;
                height: 297mm;

            }

            .page {
                margin: 0;
                border: initial;

                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        #header {
            position: fixed;
            left: 0px;
            top: -165px;
            right: 0px;
        }

        #content {
            left: 0px;
            top: 0px;
            right: 0px;
            padding-top: 10px
        }

        #footer {
            position: fixed;
            left: 0px;
            bottom: -180px;
            right: 0px;
            height: 50px;
            border: 2px solid red
        }

        .page-break {
            page-break-after: always;
        }

        div {
            margin: 0px;
            padding: 4px;

        }



        table {
            border-collapse: collapse;
            border: 2px solid gray;
        }

        td {
            padding: 3px;
        }

        .ql-align-justify{
            text-align: justify;
  text-justify: inter-word;
}
       
    </style>
</head>


<body>

    <div class="book">
        <div class="page">

            <div id="header1">

                <table width="100%">
                    <tr>
                        <td width="10%" align="center" rowspan=3 style=" border: 1px solid gray">

                            <p style="margin: 0px;">
                                <span><img width=110px height=61 src="{{ url('/img/LogotipoETS.png') }}"></span>
                            </p>



                        </td>

                        <td width="50%" align="center" rowspan="3"
                            style="font-family:'Verdana',sans-serif; border: 1px solid gray">

                            <p style="color:blue;margin: 0px;">
                                <b><span>
                                        {{__('CIRCULACION Y GESTION DEL SERVICIO')}}
                                    </span></b>
                            </p>
                            <p style="margin: 0px;">
                                <b><span>{{__('AVISO Nº: ')}}</span></b><b><span>{{$ficha->code}}</span></b>
                            </p>


                        </td>

                        <td width="20%" colspan="2" align="center"
                            style="font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                            <p style="font-size:8.0pt;color:blue;margin: 0px;"><b><span>{{Str::upper(
                                        $ficha->category->name)}}</span></b>
                            </p>
                        </td>
                    </tr>


                    <tr>
                        <td width="8%" align="center"
                            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{__('VERSIÓN')}}
                                    </span></b>
                            </p>


                        </td>


                        <td width="10%" align="center"
                            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{$ficha->version}}
                                    </span></b>
                            </p>


                        </td>




                    </tr>


                    <tr>
                        <td width="8%" align="center"
                            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{__('FECHA')}}
                                    </span></b>
                            </p>


                        </td>

                        <td width="10%" align="center"
                            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray; background:#F1F1F1;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{$ficha->updated_at->format('d-m-Y')}}
                                    </span></b>
                            </p>


                        </td>

                    </tr>


                    <tr>

                        <td width="15%" align="center" style="font-size:8.0pt; border: 1px solid gray; height: 10px;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{__('TÍTULO')}}
                                    </span></b>
                            </p>


                        </td>

                        <td width="85%" align="center" colspan=3
                            style="font-family:'Verdana',sans-serif; border: 1px solid gray;height: 10px;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{$ficha->title}}
                                    </span></b>
                            </p>


                        </td>


                    </tr>
                    <tr>
                        <td width="15%" align="center"
                            style="font-size:8.0pt;font-family:'Verdana',sans-serif; border: 1px solid gray;height: 50px;">

                            <p style="color:gray;margin: 0px;">
                                <b><span>
                                        {{__('INSTALACIONES / DESCRIPCIÓN')}}
                                    </span></b>
                            </p>


                        </td>

                        <td width="85%" align="center" colspan=3
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

            <div id="content1" style="border: 2px solid gray; margin: 5px;" width="100%">

                @foreach ($ficha->capitulos as $capitulo)


                <div >


                    <p style="color:blue;margin: 2px; font-weight: bold; font-size: large;text-decoration: underline;">
                        {{$capitulo->title}}

                    </p>

                   
                 
                        {!!$capitulo->body!!}
                   
                      


                    




                </div>
               

                @endforeach

            </div>
        </div>
    </div>





</body>

</html>
