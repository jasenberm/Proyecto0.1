<?php

namespace App\Http\Controllers\SuperUser;

use App\Exports\ClientExport;
use App\Exports\OwnerExport;
use App\Exports\RestaurantExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        return view('superUser.export.index');
    }

    public function client()
    {
        return Excel::download(new ClientExport, 'clientes.xlsx');
    }

    public function owner()
    {
        return Excel::download(new OwnerExport, 'dueños.xlsx');
    }

    public function restaurant()
    {
        return Excel::download(new RestaurantExport, 'restaurantes.xlsx');
    }
}
