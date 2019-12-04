<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use App\CategoryRestaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', auth()->id())->get();
        $categoryRestaurant = [];
        foreach ($restaurants as $key => $value) {
            $categoryRestaurant = Restaurant::find($value->id)->category_restaurant;
        }
        
        return view('admin.restaurant.index', compact('restaurants', 'categoryRestaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryRestaurant = CategoryRestaurant::all();
        return view('admin.restaurant.create', compact('categoryRestaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'name_restaurant' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);
        $restaurant = new Restaurant();

        $restaurant->user_id = auth()->id();
        $restaurant->category_restaurant_id = $request->category;
        $restaurant->name_restaurant = $request->name_restaurant;
        $restaurant->description = $request->description;
        $restaurant->address = $request->address;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('successMsg', 'Restaurante Creado y Registrado Correctamente');
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
        $restaurant = Restaurant::find($id);
        $categoryRestaurant = CategoryRestaurant::all();
        //dd($restaurant->category_restaurant->id);
        return view('admin.restaurant.edit', compact('restaurant', 'categoryRestaurant'));
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
        $this->validate($request, [
            'category' => 'required',
            'name_restaurant' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);
        $restaurant = Restaurant::find($id);

        $restaurant->user_id = auth()->id();
        $restaurant->category_restaurant_id = $request->category;
        $restaurant->name_restaurant = $request->name_restaurant;
        $restaurant->description = $request->description;
        $restaurant->address = $request->address;
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('successMsg', 'Restaurante Modificado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
