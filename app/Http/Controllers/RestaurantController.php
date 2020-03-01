<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant == null) {
            return redirect('/');
        } else {
            if (request()->has('category')) {
                //dd(request('category'));
                $items = Item::inRandomOrder()->join('categories', 'items.category_id', '=', 'categories.id')
                    ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')
                    ->where('restaurants.id', $restaurant->id)
                    ->where('categories.slug', request('category'))
                    ->select('items.name', 'items.image', 'items.description', 'items.price', 'categories.slug', 'categories.id')
                    ->paginate(4)
                    ->appends('category', request('category'));

                //dd($items);
            } else {
                $items = Item::join('categories', 'items.category_id', '=', 'categories.id')
                    ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')
                    ->where('restaurants.id', $restaurant->id)
                    ->select('items.name', 'items.image', 'items.description', 'items.price', 'categories.slug', 'categories.id')
                    ->paginate(4);
            }

            $categories = Restaurant::find($id)->categories;
            $sliders = Restaurant::find($id)->sliders;

            // return view('restaurant', compact('restaurant', 'categories', 'items', 'sliders'));
            return view('nuevoRestaurant', compact('restaurant', 'categories', 'items', 'sliders'));
        }
    }
}
