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
            $categories = Restaurant::find($id)->categories;
            $sliders = Restaurant::find($id)->sliders;

            //$items = Category::find(2)->items;
            //dd($restaurant);
            $itemSub = collect();
            $items = collect();

            foreach ($categories as $key => $category) {
                //$itemSub->push(Item::Where('category_id', $category->id)->get());
                $itemSub->push(Category::find($category->id)->items);
            }

            foreach ($itemSub as $key => $value) {
                foreach ($value as $key => $item) {
                    $items->push($item);
                }
            }

            return view('restaurant', compact('restaurant', 'categories', 'items', 'sliders'));
        }
    }
}
