<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Item;
use App\Slider;
use App\Reservation;
use App\Contact;
use App\Restaurant;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');
        if ($valRestaurant->isEmpty()) {
            $categoryCount = 0;
            $itemCount = 0;
            $sliderCount = 0;
            $reservations = collect();
            $contactCount = 0;
        } else {
            foreach ($valRestaurant as $key => $value) {
                $categoryCount = Restaurant::find($value->id)->categories->count();
                $categoryInfo = Restaurant::find($value->id)->categories;
                $sliderCount = Restaurant::find($value->id)->sliders->count();
                $reservations = Reservation::where([['restaurant_id', $value->id], ['status', false]])->get();
                $contactCount = Restaurant::find($value->id)->contacts->count();
                //dd($contactCount);
            }

            $itemCount = 0;
            foreach ($categoryInfo as $key => $value) {
                $items = Category::find($value->id)->items->count();
                $itemCount = $itemCount + $items;
            }
        }
        return view('admin.dashboard', compact('categoryCount', 'itemCount', 'sliderCount', 'reservations', 
            'contactCount'));
    }
}
