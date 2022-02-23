<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class MailController extends Controller
{
    public function email() {
        return (new MailMessage())
            ->subject('Welcome To Link Pro!')
            ->markdown('emails.welcome', ['data' => ['email' => 'mcirami@gmail.com', 'password'=> 'jdf893r'] ]);
    }
}
