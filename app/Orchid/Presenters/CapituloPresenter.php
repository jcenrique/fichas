<?php

namespace App\Orchid\Presenters;

use App\Models\Capitulo;

use Orchid\Support\Presenter;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;

class CapituloPresenter extends Presenter implements  Searchable
{

    // public function __construct(Capitulo $capitulo)
    // {
    //     $this->entity =$capitulo;
    // }
    public function label(): string
    {
        return __('Capitulos');
    }


    public function title(): string
    {
        return __('Ficha:<br>') .$this->entity->ficha->title;
    }
    public function subTitle(): string
    {
        return __('Capítulo:<br>') . $this->entity->title;
    }
    public function description(): string
    {
        return $this->entity->ficha->description;
    }
    /**
    * @return string
    */
    public function url(): string
    { 
        return route('fichas.show', ['id' => $this->entity->ficha->id]);
    }

    public function image(): ?string
    {
        return $this->entity->ficha->category->image;
    }

    

    /**
     * @param string|null $query
     *
     * @return Builder
     */
    public function searchQuery(string $query = null): Builder
    {
               
        return $this->entity->search( $query )->where('status', true);
    }

    /**
     * @return int
     */
    public function perSearchShow(): int
    {
        return 5;
    }
}
