<?php

namespace App\Exports;

use App\Restaurant;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RestaurantExport implements FromView
{
    public function view(): View
    {
        return view('superUser.export.restaurant_list', [
            'restaurants' => Restaurant::all()
        ]);
    }
}
