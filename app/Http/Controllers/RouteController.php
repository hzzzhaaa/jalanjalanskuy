<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function err500() {
        return view('500');
    }

    public function err404() {
        return view('404');
    }

    public function contact() {
    return view('attendee/pages/contact');
    }

    public function howit() {
    return view('attendee/pages/howit');
    }


    public function mailable() {
        $ticket = Ticket::find(2);
        $user = User::find(5);

        return new TicketMail($ticket,$user,3);
    }

}
