<?php

namespace App\Models;

use App\Observers\OnlySearchableModelObserver;
use App\Orchid\Presenters\CapituloPresenter;
use Illuminate\Support\Str;
use Orchid\Attachment\Attachable;
use Spatie\EloquentSortable\Sortable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Scope;
use Laravel\Scout\Searchable;

use OwenIt\Auditing\Contracts\Auditable;

class Capitulo extends Model implements Sortable, Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    use SoftDeletes;
    use Attachable;
    use Searchable;
    use SortableTrait;

    protected $withCount = ['audits'];
    public $sortable = [
        'order_column_name' => 'orden',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'title',
        'ficha_id',
        'orden',
        'status',
        'body',



    ];


    protected static function boot()
    {
        parent::boot();



        static::addGlobalScope(new OrdenScope);
    }

    public function generateTags(): array
    {
        return [
            $this->ficha->version,

        ];
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

    public function toSearchableArray()
    {

        // Customize array...

        return ['id' => $this->id, 'title' => (string) $this->title, 'body' => $this->body, 'status' => $this->status];
    }

    public function presenter(): CapituloPresenter
    {
        return new CapituloPresenter($this);
    }
}

class OrdenScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        return $builder->where('capitulos.orden', '!=', null);
    }
}
