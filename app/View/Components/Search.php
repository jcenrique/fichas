<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Search extends Component
{


    public $search = "Mi busqueda";

    public $results;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->search=$search;
    //    $this->results =$results;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search');
    }
}
