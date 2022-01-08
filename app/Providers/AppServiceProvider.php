<?php

namespace App\Providers;

use App\Models\Capitulo;
use App\Models\Ficha;
use App\Models\User;
use App\Observers\FichaObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
use Orchid\Icons\IconFinder;
use Orchid\Platform\Dashboard;
use Orchid\Screen\TD;
use OwenIt\Auditing\Models\Audit;

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
                return view('components.bool', [
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
    public function boot(Dashboard $dashboard, IconFinder $iconFinder)
    {
        Ficha::observe(FichaObserver::class);
        User::observe(UserObserver::class);

        $dashboard->registerSearch([
           Ficha::class,
           Capitulo::class,
          //User::class,
            //...Models
        ]);

        Audit::creating(function (Audit $model) {
            if (empty($model->old_values) && empty($model->new_values)) {
                return false;
            }
        });

        $iconFinder->registerIconDirectory('fa', resource_path('icons/fontawesome'));
    }
}
