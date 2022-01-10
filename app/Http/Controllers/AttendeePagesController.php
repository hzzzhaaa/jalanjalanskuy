<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;

class AttendeePagesController extends Controller
{
    //

    public function event() {
        return view('attendee/pages/event',['events'=>Event::all()->take(4)]);
    }
}
