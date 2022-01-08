<?php

namespace App\Observers;

use App\Models\Ficha;

class FichaObserver
{
    /**
     * Handle the Ficha "created" event.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return void
     */
    public function created(Ficha $ficha)
    {
        //
    }

    /**
     * Handle the Ficha "updated" event.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return void
     */
    public function updated(Ficha $ficha)
    {
        $ficha->capitulos()->update(['status' => $ficha->status]) ;
    }

    /**
     * Handle the Ficha "deleted" event.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return void
     */
    public function deleted(Ficha $ficha)
    {
        
    }

    /**
     * Handle the Ficha "restored" event.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return void
     */
    public function restored(Ficha $ficha)
    {
    }



    /**
     * Handle the Ficha "force deleted" event.
     *
     * @param  \App\Models\Ficha  $ficha
     * @return void
     */
    public function forceDeleted(Ficha $ficha)
    {
        //
    }

    public function deleting(Ficha $ficha)
    {
       
        $ficha->update(['status' => 0]);
    }
}
