<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RestaurantClientExport;
use App\Exports\RestaurantItemExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportRestaurantController extends Controller
{
    public function client()
    {
        return Excel::download(new RestaurantClientExport(), 'clientes.xlsx');
    }

    public function item()
    {
        return Excel::download(new RestaurantItemExport, 'items.xlsx');
    }
}
