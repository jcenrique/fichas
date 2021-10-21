<?php

namespace App\Models;

use Illuminate\Support\Str;
use Orchid\Screen\AsSource;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Attachment\Attachable;
use Illuminate\Support\Facades\Log;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use App\Orchid\Presenters\FichaPresenter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ficha extends Model implements Auditable
{
    use HasFactory;
    use AsSource;
    use SoftDeletes ,CascadeSoftDeletes;
    use Attachable;
    use  Filterable;
    use Searchable;
    use HasStatuses;

    use \OwenIt\Auditing\Auditable;


    protected $cascadeDeletes = ['capitulos'];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'code',
        'description',


    ];
    protected $allowedFilters = [

        'category_id',
        'code',
        'title'
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'user_id',
        'category_id',
        'title',
        'code',
        'status',
        'publish_at',
        'created_at',
        'deleted_at',
    ];
    protected $withCount = ['capitulos', 'audits'];

    public static function boot() {

	    parent::boot();

	    static::created(function($item) {
	        Log::info('Item Created Event:'.$item);
	    });



	}

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::of($value)->upper();
    }

    public function presenter(): FichaPresenter
    {
        return new FichaPresenter($this);
    }



    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }


    public function category()

    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCodigoAttribute(): string
    {
        return $this->category->num . '-' . date('y') . '-' . $this->category->code;
    }

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }

    public function scopeOrderCapitulo($query)
    {

        return $this->capitulos()->max('order') + 1;
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
public function ficha()
{
    return $this->morphTo()->withTrashed();
}
}
