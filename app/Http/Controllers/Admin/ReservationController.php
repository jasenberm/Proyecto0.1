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
        $reservation->save();
        $this->SendEmailVerificationAccount($id);
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
        try {
            $email_service = new emailService();

            $subject = "Correo de Confirmación";
            $params = array(
                'email' => $email,
                'name' => $reservMail->name,
                'date_time' => $reservMail->date_and_time,
                'message' => $reservMail->message,
            );

            $email_service->SendEmail($email, $subject, 'emails/emailConfirmation', $params);
        } catch (\Exception $ex) {
            return response()->json(['message' => $ex->getMessage(), 'status' => $ex->getCode()], 404);
        }
    }
}
