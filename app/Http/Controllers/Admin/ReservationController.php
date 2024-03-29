<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\services\emailService;
use App\Http\Controllers\Controller;
use App\Reservation;
use Brian2694\Toastr\Facades\Toastr;
use App\Notifications\ReservationConfirmed;
use Illuminate\Support\Facades\Notification;
use function Opis\Closure\serialize;
use App\Restaurant;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;


class ReservationController extends Controller
{
    public function index()
    {
        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        if ($valRestaurant->isNotEmpty()) {
            foreach ($valRestaurant as $key => $value) {
                //dd($valRestaurant);
                $reservations = Restaurant::find($value->id)->reservations;
                //dd($reservations);
            }
            return view('admin.reservation.index', compact('reservations', 'valRestaurant'));
        } else {
            $reservations = collect();
            return view('admin.reservation.index', compact('reservations', 'valRestaurant'));
        }
    }

    public function status($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = true;
        //$reservation->save();
        //$this->SendEmailVerificationAccount($id);

        $this->envioCorreo($id);

        /*Notification::route('mail', $reservation->email)
            ->notify(new ReservationConfirmed());*/
        Toastr::success('Reservación Confirmada Extitosamente', 'Exito!', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function destory($id)
    {
        Reservation::find($id)->delete();
        Toastr::success('Reservacion Eliminada con exito', 'Exito', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    public function SendEmailVerificationAccount($id)
    {
        $reservMail = Reservation::find($id);
        $email = $reservMail->email;

        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        foreach ($valRestaurant as $value) {
            $idRest = $value->id;
        }

        $restaurant = Restaurant::find($idRest);
        $nameRest = strtoupper($restaurant->name_restaurant);

        try {
            $email_service = new emailService();

            $subject = "Correo de Confirmación";
            $params = array(
                'email' => $email,
                'name' => $reservMail->name,
                'date' => $reservMail->date,
                'time' => $reservMail->time,
                'people' => $reservMail->people,
                'message' => $reservMail->message,
                'restaurant' => $nameRest
            );
            // dd($email);
            $email_service->SendEmail($email, $subject, 'emails/emailConfirmation', $params);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'status' => $ex->getCode()], 404);
        }
    }

    public function show($id)
    {
        $reservations = Reservation::find($id);
        return view('admin.reservation.show', compact('reservations'));
    }

    public function envioCorreo($id)
    {        
        $reservMail = Reservation::find($id);
        $email = $reservMail->email;

        $valRestaurant = Restaurant::where('user_id', auth()->id())->get('id');

        foreach ($valRestaurant as $value) {
            $idRest = $value->id;
        }

        $restaurant = Restaurant::find($idRest);
        $nameRest = strtoupper($restaurant->name_restaurant);
        
        
            $subject = "Correo de Confirmación";
            $params = array(
                'name' => $reservMail->name,
                'date' => $reservMail->date,
                'time' => $reservMail->time,
                'people' => $reservMail->people,
                'message' => $reservMail->message,
                'restaurant' => $nameRest
            );
            // dd($email);
            Mail::to($email)->send(new ReservationConfirmation($params));
            //dd('llega');

    }
}
