<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Orchid\Platform\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    public function fichas()
    {
        return $this->belongsToMany(Ficha::class);
    }
}
