<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $title = 'Reset Password';
        $body = 'Thank you for participating!';

        Mail::to('amway8534@gmail.com')->send(new SendEmail($title, $body));

        return "Email sent successfully!";
    }
}
