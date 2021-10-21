<?php

namespace App\Orchid\Presenters;

use Orchid\Screen\Contracts\Cardable;
use Orchid\Support\Presenter;
use Orchid\Support\Color;
use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;

class FichaPresenter extends Presenter implements Cardable,Searchable
{

    public function label(): string
    {
        return 'Fichas';
    }


    public function title(): string
    {

        return $this->entity->title;
    }
    public function subTitle(): string
    {
        return $this->entity->category->name;
    }
    public function description(): string
    {

        return $this->entity->description;
    }
     /**
     * @return string
     */
    public function url(): string
    {
        return route('fichas.show',['id' => $this->entity->id]);
    }

    public function image(): ?string
    {
        return $this->entity->category->image;
    }

    public function color(): ?Color
    {
        return  Color::SUCCESS();
    }


    /**
     * @param string|null $query
     *
     * @return Builder
     */
    public function searchQuery(string $query = null): Builder
    {

        return $this->entity->search($query);
    }

    /**
     * @return int
     */
    public function perSearchShow(): int
    {
        return 3;
    }
}
