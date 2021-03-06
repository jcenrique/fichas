<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Fichas\FichaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Orchid\Screens\Fichas\FichaListScreen;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/', HomeController::class)->name('home')->middleware(['auth']);

Route::get('/fichas-category/{category_id?}', [FichaController::class, 'list'])->name('fichas.list')->middleware(['auth']);

Route::get('/ficha/show/{id?}', [FichaController::class, 'show'])->name('fichas.show')->middleware(['auth']);



Route::get('/ficha/ficha-pdf/{id?}', [FichaController::class, 'fichaPDF'])->name('fichas.fichaPDF')->middleware(['auth']);
Route::get('/ficha/ldap-conect/', [FichaController::class, 'ldapConect'])->name('fichas.ldapConect')->middleware(['auth']);