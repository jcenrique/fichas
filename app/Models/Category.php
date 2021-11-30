<?php

namespace App\Models;

use App\Orchid\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Category extends Model
{
   
    use HasFactory;
   use AsSource;
    use Filterable;

    protected $withCount = [ 'fichas'];

    protected $fillable =[
        'name',
        'code',
        'num',
        'description',
        'image'
    ];

        /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',

    ];

    /**
 * Name of columns to which http filter can be applied
 *
 * @var array
 */
protected $allowedFilters = [
    'name',
];



    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }


    public function presenter(): CategoryPresenter
    {
        return new CategoryPresenter($this);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = mb_strtoupper($value);
    }

    
}
