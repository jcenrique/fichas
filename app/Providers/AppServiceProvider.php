<?php

namespace App\Providers;

use App\Models\Ficha;
use App\Observers\FichaObserver;
use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Screen\TD;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        TD::macro('bool', function () {

            $column = $this->column;

            $this->render = function ($datum) use ($column) {

                return view('components.bool',[
                    'bool' => $datum->$column
                ]);
            };

            return $this;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        Ficha::observe(FichaObserver::class);
        $dashboard->registerSearch([
            Ficha::class,
            //...Models
          ]);
    }
}
