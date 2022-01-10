<?php

namespace App\Http\Controllers;

use App\Deadline;
use App\Event;
use App\Division;
use App\Job;
use Auth;
use Carbon\Carbon;
use Hashids;
use Log;
use DateTime;
use Hashids\Hashids as HashidsHashids;
use Illuminate\Support\Facades\Mail;
use Session;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Parser\Reader;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        return view('dashboard/pages/division_create', ['event'=>$event]);
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
        ]);


        $division = Division::create([
            'name' => $request->name,
            'event_id' => $event->id

        ]);
        return redirect('dashboard/event/ '. Hashids::connection(\App\Event::class)->encode($event->id) .'/div/'. Hashids::connection(\App\Division::class)->encode($division->id)  );
    }

    public function jobs_store(Request $request, Event $event, Division $division)
    {
        $user = Auth::user();
        if(!$user->isOrganizerAdmin()) {
            return abort(401,'Unauthorized Action');
        }

        $this->validate($request, [
            'date' => 'required',
        ]);
        $dateLocale = DateTime::createFromFormat('d-m-Y', $request->date);

        $dateToSave = $dateLocale->format('Y-m-d');

        $deadline = Deadline::create([
            'date' => $dateToSave,
            'division_id' => $division->id
        ]);

        // dd($request);
        if($request->tasks!=null){
            foreach($request->tasks as $each) {
                if($each['task']==null) continue;
                $job = Job::create([
                    'name' => $each['task'],
                    'deadline_id'=>$deadline->id,
                    'status' => 0,
                    'overdue' => 0,

                ]);
                // dd($each['task_name']);
            }
        }

        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id) .'/div/' . Hashids::connection(\App\Division::class)->encode($division->id));
    }
    //, ['event'=>$event], ['division'=>$division]

    public function jobUpdate(Event $event,Division $division, Deadline $deadline, Request $request)
    {
        // dd($request);

        $user = Auth::user();
        if(!$user->isOrganizerAdmin()) {
            return abort(401,'Unauthorized Action');
        }

        $datenow =  Carbon::now();

        $deadlineDate = $deadline->date;



        foreach($deadline->jobs as $ea) {
            // dd($ea);
            $job = Job::find($ea->id);

            if($deadlineDate < $datenow) {
                $job->update([
                    'status' => ($request->input('check_' . $ea->id) == 1 ? 1 : 0),
                    'overdue' => 1
                ]);
            }else {
                $job->update([
                    'status' => ($request->input('check_' . $ea->id) == 1 ? 1 : 0),
                    'overdue' => 0
                ]);

            }

        }
        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id) .'/div/' . Hashids::connection(\App\Division::class)->encode($division->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Division $division)
    {
        return view('dashboard/pages/jobs', ['event'=>$event, 'division'=>$division]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDeadline(Request $request, Division $division)
    {
        $user = Auth::user();
        if(!$user->isOrganizerAdmin()) {
            return abort(401,'Unauthorized Action');
        }

        $this->validate($request, [
            'date' => 'required',
        ]);
        $dateLocale = DateTime::createFromFormat('d-m-Y', $request->date);

        $dateToSave = $dateLocale->format('Y-m-d');

        $deadline = Deadline::update([
            'date' => $dateToSave,
            'division_id' => $division->id
        ]);

        // dd($request);
        if($request->tasks!=null){
            foreach($request->tasks as $each) {
                if($each['task']==null) continue;
                $job = Job::update([
                    'name' => $each['task'],
                    'deadline_id'=>$deadline->id,
                    'status' => 0,
                    'overdue' => 0,

                ]);
                // dd($each['task_name']);
            }
        }

        return redirect('dashboard/event/'. Hashids::connection(\App\Event::class)->encode($event->id) .'/div/' . Hashids::connection(\App\Division::class)->encode($division->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
