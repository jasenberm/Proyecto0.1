<?php

namespace App\Exports;

use App\Reservation;
use App\Restaurant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RestaurantClientExport implements FromView
{
    public function view(): View
    {
        $user = auth()->id();
        $restaurantArray = Restaurant::where('user_id', $user)->get();
        foreach ($restaurantArray as $restaurant) {
            $id = $restaurant->id;
        }

        //$reservations = Reservation::where('restaurant_id', $id)->get()->unique('email');
        //dd($reservations);        

        return view('admin.export.client_list', [
            'users' => Reservation::where('restaurant_id', $id)->get()->unique('email')
        ]);
    }
}
