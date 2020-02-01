<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Support\Carbon;
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
        $categoryRestaurant = CategoryRestaurant::where('status', 1)->get();
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
            'ruc' => 'required|digits:13',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name_restaurant);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('upload/restaurant')) {
                mkdir('upload/restaurant', 0777, true);
            }
            $image->move('upload/restaurant', $imagename);
        } else {
            $imagename = 'default.jpg';
        }

        $restaurant = new Restaurant();
        $restaurant->user_id = auth()->id();
        $restaurant->category_restaurant_id = $request->category;
        $restaurant->name_restaurant = $request->name_restaurant;
        $restaurant->ruc = $request->ruc;
        $restaurant->image = $imagename;
        $restaurant->description = $request->description;
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
            'ruc' => 'required|digits:13',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $restaurant = Restaurant::find($id);
        $image = $request->file('image');
        $slug = str_slug($request->name_restaurant);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('upload/restaurant')) {
                mkdir('upload/restaurant', 0777, true);
            }
            //unlink('upload/restaurant/' . $restaurant->image);
            $image->move('upload/restaurant', $imagename);
        } else {
            $imagename = $restaurant->image;
        }

        $restaurant->user_id = auth()->id();
        $restaurant->category_restaurant_id = $request->category;
        $restaurant->name_restaurant = $request->name_restaurant;
        $restaurant->ruc = $request->ruc;
        $restaurant->image = $imagename;
        $restaurant->description = $request->description;
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
