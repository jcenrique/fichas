<?php

namespace App\Orchid\Presenters;

use Orchid\Support\Color;
use Orchid\Support\Presenter;
use Orchid\Screen\Contracts\Cardable;

class CategoryPresenter extends Presenter implements Cardable
{

    public function title(): string
    {
        return $this->entity->name;
    }

    public function description(): string
    {
        return $this->entity->description;
    }

    public function image(): ?string
    {
        return $this->entity->image;
    }

    public function color(): ?Color
    {
        return $this->entity->amount > 0
            ? Color::SUCCESS()
            : Color::DANGER();
    }
}
