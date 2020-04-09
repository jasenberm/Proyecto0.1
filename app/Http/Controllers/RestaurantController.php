<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Reservation;
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
            $items = Item::join('categories', 'items.category_id', '=', 'categories.id')
                ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')
                ->where('restaurants.id', $restaurant->id)
                ->select('items.name', 'items.image', 'items.description', 'items.price', 'categories.slug', 'categories.id')
                ->paginate(32);
            $categories = Restaurant::find($id)
                ->categories;
            $reservaciones = Reservation::where('user_id', auth()->id())
                ->limit(20)
                ->orderBy('date', 'desc')
                ->get();

            return view('nuevoRestaurant', compact('restaurant', 'categories', 'items', 'reservaciones'));
        }
    }
}
