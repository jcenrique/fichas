<?php

namespace App\Orchid\Screens\Fichas;

use App\Models\Category;
use App\Orchid\Layouts\Fichas\CategoryListLayout;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class CategoryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lista de categorías';


    public $category_description = "";
    public $category_description_eu = "";


    /**
     * description
     *
     * @var string
     */
    public $description = "Lista de categorías disponibles para la creación de fichas";



    public $permission = [
        'platform.fichas.categories'
    ];


    public function __construct()
    {
        $this->name = __('Lista de categorías');
        $this->description = __('Lista de categorías disponibles para la creación de fichas');
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Category $category, Request $request): array
    {

        //  $request->user()->can('index', $category);
        // $this-> authorize($category);

        return [
            'categories' => Category::filters()->paginate(10),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Crear nueva'))
                ->myTooltip(__('Crear un nueva Categoría'))
                ->icon('pencil')
                ->route('platform.category.edit')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            CategoryListLayout::class,
            Layout::modal(
                'oneAsyncModal',
                Layout::view('layouts.category-description', ['description' => $this->category_description, 'description_eu' => $this->category_description_eu]),
            )
                ->withoutApplyButton(true)
                ->async('asyncGetCategory'),

        ];
    }

    public function asyncGetCategory(Category   $category): array
    {
        $this->category_description = $category->description;
        $this->category_description_eu  = $category->description_eu;

        return [
            'category' => $category,
        ];
    }



    public function cerrarModal()
    {
        return redirect()->route('platform.categories.list');
    }
}
