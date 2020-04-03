<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Restaurant;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        if ($valRestaurant->isNotEmpty()) {
            foreach ($valRestaurant as $key => $value) {
                $categories = Restaurant::find($value->id)->categories;
            }
            return view('admin.category.index', compact('categories', 'valRestaurant'));
        } else {
            $categories = collect();
            return view('admin.category.index', compact('categories', 'valRestaurant'));
        }
        //$categories = Restaurant::find(auth()->id())->categories;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => ['required']
        ]);
        $category = new Category();
        $restaurantVal = Restaurant::where('user_id', auth()->id())->get('id');
        //dd($restaurantVal->id);
        if ($restaurantVal->isEmpty()) {
            return redirect()->route('category.index')->with('alertMsg', 'No se pueden agregar categorias sin crear el restaurante');
        } else {
            foreach ($restaurantVal as $key => $value) {
                $restaurant = $value->id;
            }
            $category->restaurant_id = $restaurant;
            $category->name = $request->name;
            $category->slug = str_slug($request->name);
            $category->save();
            Toastr::success('Nueva Clasificación Registrada Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
            // return redirect()->route('category.index')->with('successMsg', 'Categoria Guardada Correctamente');
            return redirect()->route('category.index');
        }
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
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
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
            'name' => ['required']
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();
        Toastr::success('Cambios Realizados Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('category.index')->with('successMsg', 'Cambios Realizados Correctamente');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        Toastr::success('Clasificación Eliminada Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->back()->with('successMsg', 'Categoria Eliminada Correctamente');
        return redirect()->back();
    }
}
