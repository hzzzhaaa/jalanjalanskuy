<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\EventFeedback;
use App\Mail\TicketMail;
use Hashids;
use Auth;
use Log;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $tickets = Ticket::where('event_id', $event->id)->get();
        return view('dashboard/pages/ticket', ['event' => $event, 'tickets'=>$tickets]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();
        if(!$user->isOrganizerAdmin()) {
            return abort(401,'Unauthorized Action');
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'limit' => 'required|numeric',
        ]);


        $ticket = Ticket::create([
            'name' => $request->name,
            'price' => $request->price,
            'limit' => $request->limit,
            'onsale' => 0,
            'event_id' => $event->id

        ]);
        return redirect('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($event->id) . '/ticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::findOrFail($id);
        // return view('attendee/pages/mytickets', compact('user'));
    }

public function mytickets()
    {
        return view('attendee/pages/mytickets');
    }

    public function onsale(Ticket $ticket)
    {
        $ticket->update(['onsale'=>1]);
        return redirect('dashboard/event/'.Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/ticket');
    }

    public function offsale(Ticket $ticket)
    {
        $ticket->update(['onsale'=>0]);
        return redirect('dashboard/event/'.Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/ticket');
    }

    public function approveAttendee(Event $event,$ticketuserid)
    {
        foreach($event->tickets as $ticket) {
            if($ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuserid)[0])->first() != null) {
                $ticketuser = $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuserid)[0])->first();
                $ticketuser->pivot->update(['approved'=>1]);
                // Session::flash('success','Berhasil Checkin '. $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->email);
                $user = $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuserid)[0])->first();
                // TODO: change to queue
                Mail::to($user)->queue(new TicketMail($ticket,$user,$ticketuserid));

            }
        }

        return redirect('/dashboard/event/' . Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/attendee');
    }

    public function declineAttendee(Event $event,$ticketuser)
    {
        foreach($event->tickets as $ticket) {
            if($ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuser)[0])->first() != null) {
                $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuser)[0])->first()->pivot
                ->update(['receipt'=>null]);
                // Session::flash('success','Berhasil Checkin '. $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->email);

            }
        }
        // $ticket->users->where('id',$user->id)->first()->pivot->update([
        //     'receipt'=>null
        // ]);
        // $ticket->users->where('id',$user->id)->first()->pivot->save();
        return redirect('/dashboard/event/' . Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/attendee');
    }

    public function removeAttendee(Event $event,$ticketuser)
    {
        foreach($event->tickets as $ticket) {
            if($ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuser)[0])->first() != null) {
                $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($ticketuser)[0])->first()->pivot
                ->delete();
                // Session::flash('success','Berhasil Checkin '. $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->email);

            }
        }
        // $ticket->users->where('id',$user->id)->first()->pivot->delete();
        return redirect('/dashboard/event/' . Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/attendee');
    }



    public function indexCheckin(Event $event)
    {
        return view('dashboard/pages/checkin',['event'=>$event]);
    }

    public function postCheckin(Request $request, Event $event)
    {

        $checkedin = false;
        foreach($event->tickets as $ticket) {
            if($ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first() != null) {
                if($ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->pivot->checkin == 1) {
                    $checkedin = true;
                    Session::flash('failed','Checkin sudah dilakukan ' . $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->email);

                }else {

                    $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->pivot
                    ->update(['checkin'=>1,'updated_at' => DateTime::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now('Asia/Bangkok'))->format('Y-m-d H:i:s')]);
                    Session::flash('success','Berhasil Checkin '. $ticket->users()->wherePivot('id',Hashids::connection('ticketuser')->decode($request->ticketuser)[0])->first()->email);
                    $checkedin = true;
                }
            }
        }
        if($checkedin == false) {
            Session::flash('failed','Gagal Checkin, Tiket tidak sesuai');
            Log::info('failed');
        }else {
            Log::info('checkedin');
        }
        // $ticket->users->where('id',$request->userid)->first()->pivot->checkin = 1;
        // $ticket->users()->wherePivot('id',3)->first();
        return redirect('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($event->id) . '/checkin');
    }

    public function uploadReceipt(Request $request,$ticketuser)
    {
        $this->validate($request, [
            'receipt' => 'required|mimes:jpeg,jpg,png|max:10000',
        ]);

        $fileName= null;

        $pivotId=Hashids::connection('ticketuser')->decode($ticketuser)[0];
        $user = Auth::user();
        $fileName = $request->receipt->getClientOriginalName().'-bukti-'.$user->name . '-' . $pivotId . '.jpg';
        $request->file('receipt')->storeAs('public/upload', $fileName);


        $user->tickets()->wherePivot('id',$pivotId)->first()->pivot->update([
            'receipt' => $fileName
        ]);

        return redirect('mytickets');
    }

    public function bookTicket(Ticket $ticket)
    {
        if($ticket->limit != null && $ticket->limit == $ticket->users->count()) {
            return back();
        }
        $user = Auth::user();
        if($ticket->price == 0 ) {
            $user->tickets()->attach($ticket->id,['approved'=>1]);
            $pivotId = $user->tickets()->where('ticket_id',$ticket->id)->orderBy('ticket_user.created_at','desc')->first()->pivot->id;
            Mail::to($user)->queue(new TicketMail($ticket,$user,$pivotId));
        }else {
            $user->tickets()->attach($ticket->id);
        }
        return redirect('mytickets');
    }

    public function feedback($ticketuser,Request $request)
    {
        $pivotId = Hashids::connection('ticketuser')->decode($ticketuser)[0];
        Auth::user()->tickets()->wherePivot('id',$pivotId)->first()->pivot->update([
            'feedback' => $request->feedback,
            'rating' =>$request ->r_input
        ]);
        // dd($pivotId);
        Session::flash('success', 'Feedback anda sudah diterima');
        return redirect('mytickets');
    }

    public function indexFeedback(Event $event)
    {
        return view('dashboard/pages/feedback',['event'=>$event]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {

        return view('dashboard/pages/edit_ticket',['ticket'=>$ticket,'event'=>$ticket->event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($request->all());
        return redirect('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/ticket');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if($ticket->users->first() == null) {
            $ticket->delete();
        } else {
            Session::flash('failed','Failed to delete because the ticket is already booked');
        }
        return redirect('dashboard/event/' . Hashids::connection(\App\Event::class)->encode($ticket->event->id) . '/ticket');
    }
}
