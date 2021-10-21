<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>

        /* Font Definitions */
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        @font-face {
            font-family: Calibri;
            panose-1: 2 15 5 2 2 2 4 3 2 4;
        }

        @font-face {
            font-family: Verdana;
            panose-1: 2 11 6 4 3 5 4 4 2 4;
        }

        @font-face {
            font-family: "Gill Sans MT";
            panose-1: 2 11 5 2 2 1 4 2 2 3;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            margin: 0cm;
            text-autospace: none;
            font-size: 12.0pt;
            font-family: "Times New Roman", serif;
        }

        p.TableParagraph,
        li.TableParagraph,
        div.TableParagraph {
            mso-style-name: "Table Paragraph";
            margin: 0cm;
            text-autospace: none;
            font-size: 12.0pt;
            font-family: "Times New Roman", serif;
        }

        .MsoChpDefault {
            font-family: "Calibri", sans-serif;
        }

        .MsoPapDefault {
            margin-bottom: 8.0pt;
            line-height: 107%;
        }

        @page WordSection1 {
            size: 595.3pt 841.9pt;
            margin: 70.85pt 3.0cm 70.85pt 3.0cm;
        }

        div.WordSection1 {
            page: WordSection1;
        }

    </style>

</head>
<body>

<table  style="margin-left:5.7pt;border-collapse:collapse">
            <tr>
                <td width=120 rowspan=3 valign=top style='width:89.8pt;border-top:1.5pt;
                    border-left: 1.5pt;border-bottom:1.0pt;border-right:1.0pt;border-color:gray;
                     border-style:solid;padding:0cm 0cm 0cm 0cm;'>

                    <p align=center>
                        <span style='font-size:10.0pt'><img width=107 height=61
                                src="{{ url('/img/LogotipoETS.png') }}"></span>
                    </p>



                </td>

                <td width=378 rowspan=3 valign=top style='width:10.0cm;border-top:solid gray 1.5pt;
                        border-left:none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.0pt; align=center'>

                        <p align=center>
                                <b><span style='font-size:11.0pt;font-family:"Verdana",sans-serif;letter-spacing:-.05pt'>
                                    CIRCULACION Y GESTION DEL SERVICIO
                                </span></b>
                        </p>
                        <p align=center>
                                <b><span style='font-size:11.0pt;font-family:"Verdana",sans-serif;
                                color:gray;letter-spacing:-.05pt'>AVISO Nº:  </span></b><b><span style='font-size:11.0pt;font-family:"Verdana",sans-serif;color:#7F7F7F;
                                letter-spacing:-.05pt'>{{$ficha->code}}</span></b>
                        </p>


                </td>

                <td  width=217 colspan=2  style='width:162.75pt;border-top:solid gray 1.5pt;
                        border-left:none;border-bottom:none;border-right:solid gray 1.5pt;background:
                        gray;'>

                        <p class=TableParagraph align=center><b><span style='font-size:10.0pt;
                            font-family:"Verdana",sans-serif;color:white;height:20.55pt'>{{Str::upper( $ficha->category->name)}}</span></b>
                        </p>
                </td>
            </tr>


            <tr>
                <td width=85  style='width:63.85pt;border-top:none;border-left:
                        none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.0pt;background:
                        #F1F1F1;height:20.55pt'>
                    <p class=TableParagraph align =center><span style='font-size:8.0pt;font-family:"Verdana",sans-serif;
                            color:gray;letter-spacing:-.05pt'>VERSIÓN</span>
                    </p>
                </td>
                <td width=132 style='width:98.9pt;border-top:none;border-left:
                        none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.5pt;background:
                        #F1F1F1;height:20.55pt'>
                    <p class=TableParagraph align=center><span style='font-size:10.0pt;font-family:"Verdana",sans-serif;
                            color:black'>{{$ficha->audits_count}}</span>
                    </p>
                </td>
            </tr>


            <tr>
                <td width=85 style='width:63.85pt;border-top:none;border-left:
                        none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.0pt;background:
                        #F1F1F1;height:20.55pt'>
                    <p class=TableParagraph  align=center><span style='font-size:8.0pt;font-family:"Verdana",sans-serif;
                        color:gray;letter-spacing:-.05pt'>FECHA</span>
                    </p>
                </td>
                <td width=132  style='width:98.9pt;border-top:none;border-left:
                        none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.5pt;background:
                        #F1F1F1;height:20.55pt'>
                    <p class=TableParagraph  align=center><span
                            style='font-size:10.0pt;font-family:"Verdana",sans-serif;color:black'>{{$ficha->updated_at->format('d-m-Y')}}</span>
                    </p>
                </td>
            </tr>


            <tr style='height:46.9pt'>
                <td width=120 style='width:89.8pt;border-top:none;border-left:
                            solid gray 1.5pt;border-bottom:solid gray 1.0pt;border-right:solid gray 1.0pt;
                            background:#F1F1F1;padding:0cm 0cm 0cm 0cm;height:46.9pt'>

                        <p class=TableParagraph align=center><span style='font-size:8.0pt;font-family:
                            "Verdana",sans-serif;color:gray;letter-spacing:-.05pt'>TÍTULO</span>
                        </p>
                </td>
                <td width=595 colspan=3  style='width:446.25pt;border-top:none;
                        border-left:none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.5pt;
                        background:#F1F1F1;padding:0cm 0cm 0cm 0cm;height:46.9pt'>
                            <p class=TableParagraph align=center><b><span style='font-size:14.0pt;font-family:"Verdana",sans-serif;
                                color:black;letter-spacing:-.05pt'>{{$ficha->title}}</span></b>
                            </p>
                </td>
            </tr>
            <tr style='height:27.35pt'>
                <td width=120 style='width:89.8pt;border-top:none;border-left: solid gray 1.5pt;border-bottom:solid gray 1.0pt;border-right:solid gray 1.0pt;
                    background:#F1F1F1;'>
                        <p class=TableParagraph align =center><span style='font-size:8.0pt;font-family:"Verdana",sans-serif;color:gray;
                            letter-spacing:-.05pt'>INSTALACIONES / DESCRIPCIÓN</span>
                        </p>
                </td>
                <td width=595 colspan=3  style='width:446.25pt;border-top:none;
                    border-left:none;border-bottom:solid gray 1.0pt;border-right:solid gray 1.5pt;
                    background:#F1F1F1;'>
                        <p class=TableParagraph align= center><b><span
                                style='font-size:9.0pt;font-family:"Verdana",sans-serif;color:black'>{{$ficha->description}}</span></b>
                        </p>
                </td>
            </tr>





@foreach ($ficha->capitulos as $capitulo)
<tr>

<td   colspan="4"  style="width:446.25pt;border-top:solid gray 1.0pt;;border-bottom:none;
        border-left: solid gray 1.5pt;border-bottom:solid gray 1.0pt;border-right:solid gray 1.5pt;">
    <div >

                <p class="TableParagraph " style="padding:0pt,0pt,0pt,0pt;"><b><span
                    style="font-size:10.0pt;font-family:Verdana,sans-serif;color:black">
                    {{$capitulo->title}}
                    </span></b>
                </p>

                <div class="p-10"  >

                    {!!$capitulo->body!!}


                </div>




    </div>



</td>
</tr>


@endforeach

</table>

</body>
</html>
