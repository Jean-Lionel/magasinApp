<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');



Route::get('product/create', 'ProductController@create')->name('product.create');

Route::resource('stockes', StockeController::class);
Route::resource('products', ProductController::class);
Route::resource('clients', ClientController::class);
Route::resource('categories', CategoryController::class);


//Cart ROUTE


Route::post('panier/ajouter','CartController@store')->name('panier.store');
Route::get('panier/index','CartController@index')->name('panier.index');
Route::delete('panier/{id}', 'CartController@destroy')->name('cart.destroy');
Route::patch('panier/{rowId}', 'CartController@update')->name('cart.update');

Route::post('update_panier', 'CartController@updatePanier')->name('cart.update_panier');

Route::get('/vider', function(){
	Cart::destroy();
});

//Checkout Router PayMent

Route::get('payement','CheckoutController@index')->name('payement');