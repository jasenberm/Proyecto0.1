<?php

namespace App\Http\Controllers\SuperUser;

use App\CategoryRestaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryRestaurant::all();

        return view('superUser.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superUser.categories.create');
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
            'name' => ['required', 'string']
        ]);
        $category = new CategoryRestaurant();
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->status = true;
        $category->save();

        Toastr::success('Categoria Guardada Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('category_admin.index')->with('successMsg', 'Categoria Guardada Correctamente');
        return redirect()->route('category_admin.index');
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
        $category = CategoryRestaurant::find($id);
        return view('superUser.categories.edit', compact('category'));
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
            'name' => ['required', 'string']
        ]);
        $category = CategoryRestaurant::find($id);
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();

        Toastr::success('Categoria Actualizada Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('category_admin.index')->with('successMsg', 'Categoria Guardada Correctamente');
        return redirect()->route('category_admin.index');
    }

    public function status($id)
    {
        $category = CategoryRestaurant::find($id);
        if ($category->status == true) {
            $category->status = false;
            $category->save();
        } elseif ($category->status == false) {
            $category->status = true;
            $category->save();
        }
        Toastr::success('Cambio de Estado Realizado Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->route('category_admin.index')->with('successMsg', 'Cambio de estado realizado correctamente');
        return redirect()->route('category_admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryRestaurant::find($id)->delete();
        Toastr::success('Categoria Eliminada Correctamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        // return redirect()->back()->with('successMsg', 'Categoria Eliminada Correctamente');
        return redirect()->back();
    }
}
