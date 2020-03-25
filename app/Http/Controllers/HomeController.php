<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Restaurant;
use App\CategoryRestaurant;
use App\Reservation;

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
        $restaurants1 = Restaurant::where('status', 1)->get();
        $reservaciones = Reservation::where('user_id', auth()->id())
            ->limit(4)
            ->orderBy('id', 'asc')
            ->get();
        $items = Item::inRandomOrder()
            ->limit(12)
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')
            ->where('restaurants.status', true)
            ->select('items.image', 'restaurants.id')->get();
        $items1 = Item::inRandomOrder()
            ->limit(9)
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->join('restaurants', 'categories.restaurant_id', '=', 'restaurants.id')
            ->where('restaurants.status', true)
            ->select('items.image', 'restaurants.id')->get();

        // informacion que se agregaran al mapa
        $markers = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );

        foreach ($restaurants1 as $key => $value) {
            $feature = array(
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$value->lng, $value->lat]
                ],
                'properties' => [
                    'name' => $value->name_restaurant,
                    'location' => $value->location
                ]
            );
            array_push($markers['features'], $feature);
        }

        return view('nuevoWellcome', compact('restaurants', 'categoryRestaurants', 'items', 'items1', 'markers', 'reservaciones'));
    }
}
