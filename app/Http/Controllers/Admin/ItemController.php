<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Category;
use Illuminate\Support\Carbon;
use App\Restaurant;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(/* $id_user */)
    {
        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        if ($valRestaurant->isNotEmpty()) {
            foreach ($valRestaurant as $key => $value) {
                $categoryInfo = Restaurant::find($value->id)->categories;
            }

            $itemSub = collect();
            foreach ($categoryInfo as $key => $value) {
                $itemSub->push(Item::Where('category_id', $value->id)->get());
            }

            $itemSub2 = collect();
            foreach ($itemSub as $key => $values) {
                foreach ($values as $key => $item) {
                    $itemSub2->push($item);
                }
            }

            $items = $itemSub2;
            return view('admin.item.index', compact('items', 'valRestaurant'));
        } else {
            $items = collect();
            return view('admin.item.index', compact('items', 'valRestaurant'));
        }


        /*$categoryInfo = Restaurant::find(auth()->id())->categories;

        $itemSub = collect();
        foreach ($categoryInfo as $key => $value) {
            $items = Item::Where('category_id', $value->id)->get();
            $itemSub->push($items);
        }

        $itemSub2 = collect();
        foreach ($itemSub as $key => $values) {
            foreach ($values as $key => $item) {
                $itemSub2->push($item);
            }
        }

        $items = $itemSub2;

        $items = Item::Where('id_user', $id_user)->get() 
        return view('admin.item.index', compact('items'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        foreach ($valRestaurant as $key => $value) {
            $categories = Restaurant::find($value->id)->categories;
        }

        if ($categories->isEmpty()) {
            return redirect()->route('item.index')->with('alertMsg', 'No se pueden agregar items sin crear las categorias a las que pertenecen');
        } else {
            return view('admin.item.create', compact('categories'));
        }
        //return view('admin.item.create', compact('categories'));
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('upload/item')) {
                mkdir('upload/item', 0777, true);
            }
            $image->move('upload/item', $imagename);
        } else {
            $imagename = 'default.png';
        }
        $item = new Item();
        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imagename;
        $item->save();
        return redirect()->route('item.index')->with('successMsg', 'Item Guardado Exitosamente');
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
        $item = Item::find($id);
        $categories = Category::all();
        return view('admin.item.edit', compact('item', 'categories'));
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);
        $item = Item::find($id);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('upload/item')) {
                mkdir('upload/item', 0777, true);
            }
            unlink('upload/item/' . $item->image);
            $image->move('upload/item', $imagename);
        } else {
            $imagename = $item->image;
        }

        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imagename;
        $item->save();
        return redirect()->route('item.index')->with('successMsg', 'Item Actualizado Exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        if (file_exists('upload/item/' . $item->image)) {
            unlink('upload/item/' . $item->image);
        }
        $item->delete();
        return redirect()->back()->with('successMsg', 'Item Eliminado Correctamente');
    }
}
