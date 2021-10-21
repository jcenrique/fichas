<?php

namespace App\Orchid\Screens\Fichas;

use App\Http\Requests\FichaRequest;
use App\Models\Ficha;
use App\Models\User;
use App\Orchid\Filters\CategoryFilter;

use App\Orchid\Layouts\Fichas\CategorySelection;
use App\Orchid\Layouts\Fichas\FichaListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Card;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class FichaListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Lista de fichas';

    public $description ='Fichas disponibles para visualizar';


    public $permission = [
        'platform.fichas.fichas'
    ];


    /**
     * Query data.
     *
     * @return array
     */
    public function query(Ficha $ficha): array
    {


        $this->exists = $ficha->exists;

        if($this->exists){
            $this->name = 'Editar ficha';
        }
        $fichas =Ficha::with('category')->filtersApply([CategoryFilter::class])->filters()->defaultSort('category_id', 'asc')->paginate(10);
        $ficha->load('attachment');

        return [
            'ficha' => $ficha,
            'fichas' =>$fichas,
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
            Link::make('Crear nueva')
            
            ->myTooltip('Crear un nueva Ficha')
            ->class('btn btn-default btn-rounded')
            ->icon('fa-regular.edit')
            ->route('platform.ficha.edit')
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
            CategorySelection::class,

            FichaListLayout::class,


        ];
    }


}
