<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use App\Item;
use App\Category;
use App\Restaurant;
use App\CategoryRestaurant;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categoryRestaurants = CategoryRestaurant::all();
        $restaurants = Restaurant::where('status', 1)->get();
        //dd($restaurants);
        return view('welcome', compact('restaurants', 'categoryRestaurants'));
    }
}
