<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant;
use Illuminate\Support\Carbon;
use App\CategoryRestaurant;
use Brian2694\Toastr\Facades\Toastr;

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

        $markers = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );

        foreach ($restaurants as $key => $value) {
            $feature = array(
                'type' => 'Feature',
                'geometry' => ['type' => 'Point', 'coordinates' => [$value->lng, $value->lat]]
            );
            # Add feature arrays to feature collection array
            array_push($markers['features'], $feature);
        }

        //        dd($restaurants);
        return view('admin.restaurant.index', compact('restaurants', 'categoryRestaurant', 'markers'));
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
            'name_restaurant' => 'required|unique:restaurants|max:28',
            'ruc' => 'required|digits:13',
            'image' => 'mimes:jpeg,jpg,bmp,png',
            'description' => 'required',
            'location' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
        ]);
        if ($request->category == "Seleccione la categoria...") {
            return redirect()->back()->with('alertMsg', 'Olvido seleccionar la categoria');
        }
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
        $restaurant->location = $request->location;
        $restaurant->lng = $request->longitud;
        $restaurant->lat = $request->latitud;
        $restaurant->facebook = $request->face;
        $restaurant->instagram = $request->insta;
        $restaurant->twiter = $request->twit;
        $restaurant->save();
        Toastr::success('Restaurante Creado y Registrado Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('restaurant.index')->with('successMsg', 'Restaurante Creado y Registrado Correctamente');
        return redirect()->route('restaurant.index');
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
        $categoryRestaurant = CategoryRestaurant::where('status', 1)->get();

        $markers = array(
            'type'      => 'FeatureCollection',
            'features'  => array()
        );
        $feature = array(
            'type' => 'Feature',
            'geometry' => ['type' => 'Point', 'coordinates' => [$restaurant->lng, $restaurant->lat]]
        );
        array_push($markers['features'], $feature);

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
            'location' => 'required',
            'longitud' => 'required',
            'latitud' => 'required',
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
        $restaurant->location = $request->location;
        $restaurant->lng = $request->longitud;
        $restaurant->lat = $request->latitud;
        $restaurant->facebook = $request->face;
        $restaurant->instagram = $request->insta;
        $restaurant->twiter = $request->twit;
        $restaurant->save();
        Toastr::success('Restaurante Modificado Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('restaurant.index')->with('successMsg', 'Restaurante Modificado Correctamente');
        return redirect()->route('restaurant.index');
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

    public function coordinates(Request $request)
    {
        $this->validate($request, [
            'lng' => 'required',
            'lat' => 'required',
        ]);


        $restaurant = Restaurant::where('user_id', auth()->id())->get();
        foreach ($restaurant as $restaurants) {
            $id = $restaurants->id;
        }

        $restaurant = Restaurant::find($id);
        $restaurant->lng = $request->lng;
        $restaurant->lat = $request->lat;
        $restaurant->save();

        return ('Ubicacion Asignada Correctamente');
    }
}
