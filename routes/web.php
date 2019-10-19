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
Route::resource('profile', 'UserController');
Route::resource('restaurant', 'RestaurantController');
Route::resource('restaurant/{restaurant_id}/consumable', 'ConsumableController');

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// home
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index2')->name('home');

// all restaurants
Route::get('/restaurant', 'RestaurantController@showAllRestaurants')->name('restaurant');

// search
Route::post('/autocomplete/fetch', 'SearchController@fetch')->name('autocomplete.fetch');

Route::get('/profile/{id}', 'HomeController@showprofile');

// profile
Route::get('editprofile', 'UserController@editProfile')->name('editprofile');
Route::get('profile', 'UserController@profile')->name('profile');
Route::get('/profile/{id}', 'UserController@show')->name('show_profile');

// restaurant
// Route::get('/restaurant/{name}', 'RestaurantController@show')->name('show_restaurant');

Route::post('store', 'RestaurantController@store')->name("restaurant.store");

// consumable
Route::get('/add/{restaurant_id}', 'ConsumableController@index')->name('add');
