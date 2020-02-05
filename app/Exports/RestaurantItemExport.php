<?php

namespace App\Exports;

use App\Item;
use App\Restaurant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RestaurantItemExport implements FromView
{
    public function view(): View
    {
        $user = auth()->id();
        $restaurantArray = Restaurant::where('user_id', $user)->get();

        foreach ($restaurantArray as $key => $value) {
            $categoryInfo = Restaurant::find($value->id)->categories;
        }

        $itemSub = collect();
        foreach ($categoryInfo as $key => $value) {
            $itemSub->push(Item::Where('category_id', $value->id)->get());
        }

        $itemSub2 = collect();
        foreach ($itemSub as $key => $values) {
            foreach ($values as $key => $item) {
                $itemSub2->push($item);
            }
        }

        $items = $itemSub2;

        return view('admin.export.item', [
            'items' => $items
        ]);
    }
}
