<?php

namespace App\Orchid\Filters;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class CategoryFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['category_id'];

    public $category_name='';
    /**
     * @return string
     */
    public function name(): string
    {
        return __('Categorías');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        //dd($builder->whereIn('category_id' , $this->request->get('category_id'))->get());

       // $this->category_name = Category:: ($this->request->get('category_id'))->first()->name;
    //    return $builder->whereHas('category', function (Builder $query) {
    //     $query->whereIn('category_id', $this->request->get('category_id'));
  // });
//dd($this->request->all());
       return $builder->whereIn('category_id' , $this->request->get('category_id'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {

        return [
        Select::make('category_id')
        ->fromModel(Category::class, 'name')
        ->multiple()

        ->value($this->request->get('category_id'))
        ->title(__('Categorías')),
        ];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name().': '.Category::whereIn('id', $this->request->get('category_id'))->get()->implode('name', ' , ');
    }
}
