<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\Category;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = '';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = '';

    public $permission = [
        'platform.index'
    ];


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'categorias' => Category::defaultSort('name')->paginate()
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

        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::view('platform::partials.welcome')
        ];
    }
}
