<?php

namespace App\services;

use SendGrid\Mail\Mail;

class EmailService
{

    public function SendEmail($emailAddress, $subject, $emailTemplate, $params)
    {
        $mail = new Mail();

        $template = $this->getTemplate($emailTemplate, $params);

        $sg = new \SendGrid(env('SENDGRID_API_KEY'));

        $mail->setFrom(env('FROM'), env('FROMNAME'));
        $mail->setSubject($subject);
        $mail->addTo($emailAddress);
        $mail->addContent("text/html", $template);
        try {
            // dd($mail);
            $sg->send($mail);
        } catch (\Exception $ex) {
            $message = "no se pudo enviar el correo electronico";
            return response()->json(['status' => 0, 'status_code' => 204, 'message' => $message], 200);
        }
    }

    public function getTemplate($emailTemplate, $params)
    {
        return view($emailTemplate, $params)->render();
    }
}
