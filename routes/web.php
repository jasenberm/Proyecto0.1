<?php

//use Illuminate\Routing\Route;

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

Route::get('/', 'HomeController@index')->name('welcome');
Route::post('/reservation', 'ReservationController@reserve')->name('reservation.reserve');
Route::post('/contact', 'ContactController@sendMessage')->name('contact.send');
Route::get('/{id}', 'RestaurantController@index')->where('id', '[0-9]+')->name('restaurant.welcome');

// Auth::routes();

Route::get('/login', 'Security\LoginController@index')->name('login');
Route::post('/login', 'Security\LoginController@login')->name('login_post');
Route::get('/logout', 'Security\LoginController@logout')->name('logout');
Route::post('/logout', 'Security\LoginController@logout')->name('logout');
Route::get('/register', 'Security\RegisterController@index')->name('register');
Route::get('/registerOwner', 'Security\RegisterController@index')->name('register_owner');
Route::post('/register', 'Security\RegisterController@register')->name('register_client_post');
Route::post('/registerOwner', 'Security\RegisterController@register')->name('register_owner_post');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin'], 'namespace' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('slider', 'SliderController');
    Route::resource('category', 'CategoryController');
    Route::resource('item', 'ItemController');
    Route::resource('restaurant', 'RestaurantController');

    Route::get('reservation', 'ReservationController@index')->name('reservation.index');
    Route::post('reservation/{id}', 'ReservationController@status')->name('reservation.status');
    Route::delete('reservation/{id}', 'ReservationController@destory')->name('reservation.destory');

    Route::get('contact', 'ContactController@index')->name('contact.index');
    Route::get('contact/{id}', 'ContactController@show')->name('contact.show');
    Route::delete('contact/{id}', 'ContactController@destroy')->name('contact.destroy');

    Route::get('maps', 'MapsController@index')->name('maps.index');
});


Route::group(['prefix' => 'superuser', 'middleware' => 'auth', 'namespace' => 'superuser'], function () {

    Route::resource('client', 'ClientController');
    Route::resource('owner', 'ClientController');
    Route::resource('category', 'CategoryRestaurantController');
    Route::resource('request', 'RequestController');
});
