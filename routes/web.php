<?php

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('ingredients/{ingredient}/consume', 'IngredientController@consume')->name('ingredients.consume');
    Route::get('ingredients/{ingredient}/deplete', 'IngredientController@deplete')->name('ingredients.deplete');
    Route::get('ingredients/{ingredient}/stockup', 'IngredientController@stockUp')->name('ingredients.stockup');
    Route::resource('ingredients', 'IngredientController');

    Route::get('{any}', function() {
        return redirect(route('ingredients.index'));
    })->where('any', '(.*)');
});
