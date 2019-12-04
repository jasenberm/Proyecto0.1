<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;

class MapsController extends Controller
{
    public function index()
    {
        return view('admin.maps.index');
    }
}
