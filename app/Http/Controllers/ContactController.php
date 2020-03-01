<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Brian2694\Toastr\Facades\Toastr;

class ContactController extends Controller
{
    public function sendMessage(Request $request, $id)
    {
        $this->validate($request, [
            'message' => 'required'
        ]);

        $usuario = auth()->user();

        $contact = new Contact();
        $contact->restaurant_id = $id;
        $contact->name = $usuario->name . ' ' . $usuario->last_name;
        $contact->email = $usuario->email;
        $contact->subject = 'Comentario';
        $contact->message = $request->message;
        $contact->save();

        Toastr::success('Su Mensaje a Sido Exitosamente Enviado', 'Exito', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
