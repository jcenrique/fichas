<?php

namespace App\Http\Controllers\Fichas;


use App\Models\Ficha;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use PDF;

class FichaController extends Controller
{


    public function  list($category_id = null)


    {

        $this->authorize('list', Ficha::class);
        $category= Category::find( $category_id);

        if ($category_id) {
            $fichas = Ficha::where(['category_id' =>$category_id])->paginate();
        } else {
            $fichas = Ficha::paginate();
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

    //return view('pdf-ficha',$ficha);
    // Lancement du téléchargement du fichier PDF
    return $pdf->stream(Str::slug($ficha->title).".pdf");

}
}
