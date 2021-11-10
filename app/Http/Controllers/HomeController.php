<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()


    {
        $this->authorize('acceso', Category::class);

       // $categorias =Category::all();
        $categorias = Category::withCount(['fichas' => function ($query) {
            $query->where('status', 1);
        }])->get();

        
        return view('welcome' ,compact('categorias'));
    }
}
