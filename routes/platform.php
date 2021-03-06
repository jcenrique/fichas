<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Fichas\CapituloEditScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\Fichas\CategoryEditScreen;
use App\Orchid\Screens\Fichas\CategoryListScreen;
use App\Orchid\Screens\Fichas\FichaCapituloEditScreen;
use App\Orchid\Screens\Fichas\FichaEditScreen;
use App\Orchid\Screens\Fichas\FichaListScreen;
use App\Orchid\Screens\PruebarelationScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
// Route::screen('/main', PlatformScreen::class)
//     ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

//categorias

Route::screen('category/{category?}', CategoryEditScreen::class)
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.categories.list')
            ->push(__('Categor??a'));
    })
    ->name('platform.category.edit');

Route::screen('categories', CategoryListScreen::class)
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(
                __('Categor??as'),
                route('platform.categories.list')
            );
    })
    ->name('platform.categories.list');


//fichas


Route::screen('ficha/{ficha?}', FichaEditScreen::class)
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.fichas.list')
            ->push(__('Ficha'));
    })
    ->name('platform.ficha.edit');


Route::screen('fichas', FichaListScreen::class)
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(
            __('Fichas'),
            route('platform.fichas.list')
        );
})
    ->name('platform.fichas.list');

    Route::screen('capitulo/{capitulo?}', CapituloEditScreen::class)
   
    ->name('platform.capitulo.edit');

    Route::screen('ficha_capitulo/{ficha?}', FichaCapituloEditScreen::class)
   
    ->name('platform.ficha-capitulo.edit');


  