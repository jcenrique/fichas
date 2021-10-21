<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Fichas')
            ->addPermission('platform.fichas.categories', 'Acceso a las categorias')
            ->addPermission('platform.fichas.fichas', 'Acceso a las fichas')
            ->addPermission('home', 'Acceso a la aplicación')
            ->addPermission('fichas', 'Vista de vichas');

        $dashboard->registerPermissions($permissions);
    }
}

