<?php

namespace App\Models;

use App\Orchid\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
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
        'description_eu',
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

protected static function boot()
{
    parent::boot();
 
    // Order by name ASC
    static::addGlobalScope('order', function (Builder $builder) {
        $builder->orderBy('name', 'asc');
    });
}

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
     /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeOrden(Builder $query)
    {
        //Log::debug($query->where('num' ,'=' ,1)->orderBy('name')->get()->toArray());
       
        return $query->where('name' ,'!=' ,'')->orderBy('name');
    }
}
