<?php

namespace App\Http\Controllers;
use App\Event;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function show ()
    {
        $event = Event::all();
        return view('attendee/pages/index', ['event' => $event]);
    }


}
