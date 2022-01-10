<?php

namespace App\Http\Controllers;

use App\Event;
use App\PaymentMethod;
use Illuminate\Http\Request;
use Auth;
use Log;
use DateTime;
use Faker\Calculator\Ean;
use Hashids;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('dashboard/pages/events',['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/pages/event_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if(!$user->isOrganizerAdmin()) {
            return abort(401,'Unauthorized Action');
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'location' => 'required',
            'date' => 'required',
            'timeStart' => 'required',
            'timeEnd' => '',
            'image' => 'required|mimes:jpeg,jpg,png|max:1000',
            'description' => 'required',
        ]);

        $fileName= null;
        if($request->image != null) {
            $fileName = $user->organizer->name . '-' . $request->name . '.jpg';
            $request->file('image')->storeAs('public/upload', $fileName);
        }

        $dateLocale = DateTime::createFromFormat('d-m-Y', $request->date);

        $dateToSave = $dateLocale->format('Y-m-d');

        $event = Event::create([
            'name' => $request->name,
            'location' => $request->location,
            'date' => $dateToSave,
            'timeStart' => $request->timeStart,
            'timeEnd' => $request->timeEnd,
            'image' => $fileName,
            'description' => $request->description,
            'organizer_id' => $user->organizer_id,
            'finished' => 0
        ]);

        if ($request->payment !=null ){
        foreach($request->payment as $each) {
            if($each['bank']==null) continue;
            $method = PaymentMethod::create([
                'bank' => $each['bank'],
                'bankAccountName' => $each['bankAccountName'],
                'bankAccountNumber' => $each['bankAccountNumber'],
                'event_id' => $event->id
            ]);
        }
    }
        return redirect('dashboard/event/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if($event->organizer_id != Auth::user()->organizer->id)
        return redirect('404');

        return view('dashboard/pages/event',['event'=>$event]);
    }


    public function show_attendee(Event $event)
    {
        return view('dashboard/pages/attendee', ['event'=>$event]);
    }

    public function show1(Event $event)
    {
        return view('attendee/pages/event_profile',['event'=>$event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('dashboard/pages/edit_event', ['event'=>$event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'location' => 'required',
            'date' => 'required',
            'timeStart' => 'required',
            'timeEnd' => '',
            'image' => 'mimes:jpeg,jpg,png|max:1000',
            'description' => 'required',
        ]);
        if($request->image != null) {

            $fileName= null;

            $fileName = $user->organizer->name . '-' . $request->name . '.jpg';
            $request->file('image')->storeAs('public/upload', $fileName);


            $dateLocale = DateTime::createFromFormat('d-m-Y', $request->date);

            $dateToSave = $dateLocale->format('Y-m-d');

            $event->update([
                'name' => $request->name,
                'location' => $request->location,
                'date' => $dateToSave,
                'timeStart' => $request->timeStart,
                'timeEnd' => $request->timeEnd,
                'image' => $fileName,
                'description' => $request->description,
                'organizer_id' => $user->organizer_id,
                'finished' => 0
            ]);
        }else {
            $dateLocale = DateTime::createFromFormat('d-m-Y', $request->date);

            $dateToSave = $dateLocale->format('Y-m-d');

            $event->update([
                'name' => $request->name,
                'location' => $request->location,
                'date' => $dateToSave,
                'timeStart' => $request->timeStart,
                'timeEnd' => $request->timeEnd,
                'description' => $request->description,
                'organizer_id' => $user->organizer_id,
                'finished' => 0
            ]);
        }


        foreach($request->payment as $each) {
            if($each['bank']==null) continue;
            if($each['paymentId'] != null) {
                $method = PaymentMethod::find($each['paymentId']);
                $method->update([
                    'bank' => $each['bank'],
                    'bankAccountName' => $each['bankAccountName'],
                    'bankAccountNumber' => $each['bankAccountNumber'],
                    'event_id' => $event->id
                ]);
            }else {
                PaymentMethod::create([
                    'bank' => $each['bank'],
                    'bankAccountName' => $each['bankAccountName'],
                    'bankAccountNumber' => $each['bankAccountNumber'],
                    'event_id' => $event->id
                ]);
            }
        }
        return redirect('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($event->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Event $event)
    // {
    //     // dd('masuk');
    //     $event->delete();
    //     return redirect('dashboard');
    // }

    // public function adminDestroy(Event $event)
    // {
    //     // dd('masuk');
    //     $event->delete();
    //     return redirect('dashboard/events');
    // }

    public function approve(Event $event)
    {
        $event->update([
            'approved'=>1
        ]);
        return redirect('dashboard/events');
    }

    public function finish(Event $event)
    {
        $event->update([
            'finished' => 1
        ]);
        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id));
    }

    public function setPublish(Event $event)
    {
        $event->update([
            'publish' => 1
        ]);
        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id));
    }
    public function setHidden(Event $event)
    {
        $event->update([
            'publish' => 0
        ]);
        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id));
    }
}
