<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('admin')
    ->as('admin.')
    ->group(function(){
        Route::get('/', function(){
            return view('Backend.dashboard');
        });
        Route::prefix('category')
        ->as('category.')
        ->controller(CategoryController::class)
        ->group(function(){
            Route::get('/',                 'index')->name('index');
            Route::get('create',            'create')->name('create');
            Route::get('search',            'search')->name('search');
            Route::post('store',            'store')->name('store');
            Route::get('{id}/show',         'show')->name('show');
            Route::get('{id}/edit',         'edit')->name('edit');
            Route::put('{id}/update',       'update')->name('update');
            Route::delete('{id}/destroy',   'destroy')->name('destroy');
        });
        Route::prefix('post')
        ->as('post.')
        ->controller(PostController::class)
        ->group(function(){
            Route::get('/',                 'index')->name('index');
            Route::get('create',            'create')->name('create');
            Route::get('search',            'search')->name('search');
            Route::post('store',            'store')->name('store');
            Route::get('{id}/show',         'show')->name('show');
            Route::get('{id}/edit',         'edit')->name('edit');
            Route::put('{id}/update',       'update')->name('update');
            Route::delete('{id}/destroy',   'destroy')->name('destroy');
        });
});
