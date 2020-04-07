<?php

namespace App\Http\Controllers\SuperUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('status', true)->get();
        //dd($restaurants);
        return view('superUser.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Restaurant::find($id);
        $user->delete();
        return redirect()->back()->with('successMsg', 'Restaurante Eliminado Correctamente');
    }

    public function status($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->status == true) {
            $restaurant->status = false;
            $restaurant->save();
        } elseif ($restaurant->status == false) {
            $restaurant->status = true;
            $restaurant->save();
        }
        return redirect()->back()->with('successMsg', 'Cambio de estado realizado correctamente');
    }
}
