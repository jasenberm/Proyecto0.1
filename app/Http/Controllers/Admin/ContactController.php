<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Brian2694\Toastr\Facades\Toastr;
use App\Restaurant;

class ContactController extends Controller
{
    public function index()
    {
        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');
        if ($valRestaurant->isNotEmpty()) {
            foreach ($valRestaurant as $key => $value) {
                //dd($valRestaurant);
                $contacts = Restaurant::find($value->id)->contacts;
                //dd($contacts);
            }
            return view('admin.contact.index', compact('contacts'));
        } else {
            $contacts = collect();
            return view('admin.contact.index', compact('contacts'));
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.show', compact('contact'));
    }

    public function destroy($id)
    {
        Contact::find($id)->delete();
        Toastr::success('Mensaje de Contacto a Sido Exitosamente Eliminado', 'Exito', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
