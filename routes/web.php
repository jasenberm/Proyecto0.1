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

Route::get('/', 'HomeController@index')->name('welcome')->middleware('guest');
Route::post('reservations/{id}', 'ReservationController@reserve')->name('reservation.reserve');
Route::post('contact/{id}', 'ContactController@sendMessage')->name('contact.send');
Route::get('/{id}', 'RestaurantController@index')->where('id', '[0-9]+')->name('restaurant.welcome');


// Auth::routes();

Route::group(['verify' => true], function () {
    
    Route::get('/login', 'Security\LoginController@index')->name('login');
    Route::post('/login', 'Security\LoginController@login')->middleware('guest')->name('login_post');
    Route::get('/logout', 'Security\LoginController@logout')->name('logout');
    Route::post('/logout', 'Security\LoginController@logout')->name('logout');
    Route::get('/register', 'Security\RegisterController@index')->name('register');
    Route::get('/registerOwner', 'Security\RegisterController@index')->name('register_owner');
    Route::post('/register', 'Security\RegisterController@register')->name('register_client_post');
    Route::post('/registerOwner', 'Security\RegisterController@register')->name('register_owner_post');
    Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
});



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified'], 'namespace' => 'admin'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('slider', 'SliderController');
    Route::resource('category', 'CategoryController');
    Route::resource('item', 'ItemController');
    Route::resource('restaurant', 'RestaurantController');
    Route::post('coordinates', 'RestaurantController@coordinates')->name('restaurnat.coordinates');


    Route::get('reservation', 'ReservationController@index')->name('reservation.index');
    Route::post('reservation/{id}', 'ReservationController@status')->name('reservation.status');
    Route::delete('reservation/{id}', 'ReservationController@destory')->name('reservation.destory');
    Route::get('reservation/{id}', 'ReservationController@show')->name('reservation.show');

    Route::get('contact', 'ContactController@index')->name('contact.index');
    Route::get('contact/{id}', 'ContactController@show')->name('contact.show');
    Route::delete('contact/{id}', 'ContactController@destroy')->name('contact.destroy');

    Route::get('maps', 'MapsController@index')->name('maps.index');

    Route::get('export/client', 'ExportRestaurantController@client')->name('export.clients');
    Route::get('export/item', 'ExportRestaurantController@item')->name('export.items');
});


Route::group(['prefix' => 'superuser', 'middleware' => ['auth', 'superuser'], 'namespace' => 'superuser'], function () {

    Route::resource('superuser', 'ClientController');
    Route::resource('client', 'ClientController');
    Route::resource('owner', 'ClientController');
    Route::resource('category_admin', 'CategoryRestaurantController');
    Route::resource('request', 'RequestController');
    Route::resource('restaurant_admin', 'RestaurantController');
    Route::put('statusCategoria/{id}', 'CategoryRestaurantController@status')->name('status.categoryRestaurant');
    Route::put('statusClient/{id}', 'ClientController@status')->name('status');
    Route::put('statusrestaurant/{id}', 'RestaurantController@status')->name('restaurant.status');
    Route::get('export/index', 'ExportController@index')->name('export.index');
    Route::get('export/clients', 'ExportController@client')->name('export.client');
    Route::get('export/owners', 'ExportController@owner')->name('export.owner');
    Route::get('export/restaurants', 'ExportController@restaurant')->name('export.restaurant');
});
