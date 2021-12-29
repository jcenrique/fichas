<?php

namespace App\Providers;

use App\Models\Ficha;
use App\Observers\FichaObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $dashboard->registerSearch([
            Ficha::class,
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
