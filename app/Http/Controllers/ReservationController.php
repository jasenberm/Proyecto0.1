<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Reservation;
use Brian2694\Toastr\Facades\Toastr;

class ReservationController extends Controller
{
    public function reserve(Request $request, $id)
    {
        //dd($request->name);
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
            'people' => 'required'
        ]);
        $usuario = auth()->user();
        //dd($usuario);
        $reservation = new Reservation();
        $reservation->restaurant_id = $id;
        $reservation->name = $usuario->name;
        $reservation->last_name = $usuario->last_name;
        $reservation->email = $usuario->email;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->people = $request->people;
        $reservation->message = $request->message;
        $reservation->status = false;
        $reservation->save();


        Toastr::success('Solicitud enviada correctamente. Espere su confirmación', 'Exito!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
