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
        $restaurants = Restaurant::where('status', 1)->paginate(12);
        //$items = Item::inRandomOrder()->limit(12)->get()        

        $items = Item::inRandomOrder()->limit(12)->join('categories', 'items.category_id', '=', 'categories.id')
            ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')->where('restaurants.status', true)
            ->select('items.image', 'restaurants.id')->get();

        // return view('welcome', compact('restaurants', 'categoryRestaurants'));
        return view('nuevoWellcome', compact('restaurants', 'categoryRestaurants', 'items'));
    }
}
