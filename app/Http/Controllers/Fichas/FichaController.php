<?php

namespace App\Http\Controllers\Fichas;


use App\Models\Ficha;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PDF;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;
use PhpOffice\PhpWord\TemplateProcessor;

class FichaController extends Controller
{


    public function  list($category_id = null)


    {

        $this->authorize('list', Ficha::class);
        $category= Category::find( $category_id);

    

        if ($category_id) {
            $fichas = Ficha::where('category_id' ,$category_id )
                                    ->where('status',1)
                                ->paginate();
        } else {
            $fichas = Ficha::where('status',1)->paginate();
        }


        return view('fichas', compact('fichas', 'category'));
    }

    public function show($id)
    {

        $ficha= Ficha::find($id);
        $this->authorize('view', $ficha);



        return view('show', compact('ficha'));
    }

//     public function fichaPDF ($id)
// {
//     $ficha= Ficha::find($id);

//     view()->share('ficha', $ficha);


//  //   $this->authorize('view', $ficha);

//     $pdf = PDF::loadView('pdf-ficha',$ficha);

//   //  return view('pdf-ficha',$ficha);
//     // Lancement du téléchargement du fichier PDF
//     return $pdf->download(Str::slug($ficha->title).".pdf");

// }

public function fichaPDF ($id)
{
    $ficha= Ficha::find($id);

    view()->share('ficha', $ficha);


 //   $this->authorize('view', $ficha);

   $pdf = PDF::loadView('pdf-ficha',$ficha)
   ->setPaper('a4');

    return view('pdf-ficha',$ficha);
    // Lancement du téléchargement du fichier PDF
   // return $pdf->stream(Str::slug($ficha->title).".pdf");

}

// public function fichaPDF($id){

//    //dd( public_path('storage') . '\plantillas\Plantillas Avisos.docx' );

//    //abro plantilla y pongo el encabezado guardo el documento y lo vuelvo abrir para añadir
//      $template = public_path('storage') . '\plantillas\Plantilla Avisos.docx';
//     // $worDoc = new TemplateProcessor($template);
//      $ficha= Ficha::find($id);
//     // //dd($ficha->capitulos->first()->body);

//     //  $worDoc->setValue('categoria', $ficha->category->name);

//     //  $worDoc->setValue('codigo', $ficha->code);


//     //  $worDoc->setValue('titulo', $ficha->title);

//     //  $worDoc->setValue('descripcion', $ficha->description);


//     //  $worDoc->setValue('version', $ficha->audits_count);

//     //  $worDoc->setValue('fecha', $ficha->updated_at->format('d-M-Y'));
//     //  $worDoc->saveAs('pruebas.docx');





//      $phpWord = new \PhpOffice\PhpWord\PhpWord();
//      $phpWord->loadTemplate($template);


//         $html =   $ficha->body;


//         \PhpOffice\PhpWord\Shared\Html::addHtml('contenido', $html, false, false);
// //$phpWord->setValue('contenido' , );

//       //  $section->addImage("./images/Logotipo ETS.jpg");

//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//         $objWriter->save('pruebas1.docx');
//         return response()->download(public_path('pruebas1.docx'));

// }



}
//
