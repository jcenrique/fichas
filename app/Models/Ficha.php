<?php

namespace App\Models;

use Illuminate\Support\Str;
use Orchid\Screen\AsSource;
use Laravel\Scout\Searchable;
use Orchid\Filters\Filterable;
use Orchid\Platform\Models\Role;
use Orchid\Attachment\Attachable;

use Illuminate\Support\Facades\Log;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Orchid\Presenters\FichaPresenter;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ficha extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use AsSource;
    use SoftDeletes ;
    use Attachable;
    use  Filterable;
    use Searchable;
    use Notifiable;
  
   

    protected $withCount = [  'capitulos','audits'];


    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'code',
        'description',
        'status',
        'version'


    ];
    protected $allowedFilters = [

        'category_id',
        'code',
        'title',
        'status',
        'version'
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
        'version',
        'publish_at',
        'created_at',
        'deleted_at',
    ];

    protected $softCascade = ['capitulos'];

    public static function boot() {

	    parent::boot();

	    static::created(function($item) {
	        Log::info('Item Created Event:'.$item);
	    });
        self::deleting(function ($model) {
            $model->status = 0;
            $model->save();
        });


	}
    public function generateTags(): array
    {
        return [
            $this->version,
          
        ];
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

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function scopeOrderCapitulo($query)
    {

        return $this->capitulos()->max('order') + 1;
    }


/**
 * {@inheritdoc}
 */
public function ficha()
{
    return $this->morphTo()->withTrashed();
}
}
