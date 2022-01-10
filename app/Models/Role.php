<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;


use Orchid\Platform\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    public function fichas()
    {
        return $this->belongsToMany(Ficha::class);
    }

    public function scopeOrden(Builder $query)
    {
       
        return $query->select('*')->orderBy('slug');
    }

}
