<?php

namespace App\Orchid\Layouts\Fichas;

use App\Orchid\Filters\CategoryFilter;

use Orchid\Crud\Filters\WithTrashed;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class CategorySelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            CategoryFilter::class,
           WithTrashed::class
        ];
    }
}
