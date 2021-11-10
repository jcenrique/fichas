<?php

namespace App\Models;

use Illuminate\Support\Str;
use Orchid\Attachment\Attachable;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Capitulo extends Model  implements  Sortable
{
    use HasFactory;
    USE SoftDeletes;
    use Attachable;

    use SortableTrait;

    protected $withCount = [ 'audits'];
    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

   protected $fillable = [
    'title',
    'ficha_id',
    'order',
    'body',



   ];


   protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }


   public function buildSortQuery()
   {
       return static::query()->where('ficha_id', $this->ficha_id);
   }

   public function setTitleAttribute($value)
   {
       $this->attributes['title'] = Str::of($value)->upper();
   }

   public function ficha()
   {
        return $this->belongsTo(Ficha::class);
   }

   /**
 * {@inheritdoc}
 */
public function auditable()
{
    return $this->morphTo()->withTrashed();
}

/**
 * {@inheritdoc}
 */
public function capitulo()
{
    return $this->morphTo()->withTrashed();
}


}
