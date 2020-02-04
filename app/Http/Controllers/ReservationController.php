<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Reservation;

class ReservationController extends Controller
{
    public function reserve(Request $request, $id)
    {
        //dd($request->name);
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
        ]);
        $usuario = auth()->user();
        //dd($usuario);
        $reservation = new Reservation();
        $reservation->restaurant_id = $id;
        $reservation->name = $usuario->name;
        $reservation->email = $usuario->email;
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->message = $request->message;

        $reservation->status = false;
        $reservation->save();
        //Toastr::success('Reservacion enviada correctamente. Espere su confirmacion', 'Exito!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
