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

public function ldapConect()
{
    
 
    $ldap_con = ldap_connect("ldap.forumsys.com",389);
    $ldap_dn = "cn=read-only-admin,dc=example,dc=com";
    $ldap_ps = "password";
 
    ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
 
    if (ldap_bind($ldap_con, $ldap_dn, $ldap_ps)):
 
        echo "Ldap binding successful";
 
        /*@ Getting data START */ 
         
        $filter = ("uid=newton"); 
         
        $results = ldap_search($ldap_con, "dc=example,dc=com", $filter);  
         
        $search_result = ldap_get_entries($ldap_con, $results);  
 
        echo var_dump($search_result);
        /*@ Getting data ENDS */   
 
     else:
 
          echo "Ldap binding not successful";
     endif;
}


}
//
