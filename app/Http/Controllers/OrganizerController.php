<?php

namespace App\Http\Controllers;

use App\Organizer;
use Illuminate\Http\Request;
use Auth;

class OrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizers = Organizer::all();
        return view('dashboard/pages/organizers',['organizers'=>$organizers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attendee/pages/make_org');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'picture' => 'mimes:jpeg,jpg,png|max:1000'
        ]);

        $picture= null;
        if($request->picture != null) {
            $picture = $request->name. '.png';
            $request->file('picture')->storeAs('public/upload', $picture);
        }
        $organizer = Organizer::create([
            'name'=>$request->name,
            'description' => $request->description,
            'picture'=> $picture
        ]);

        Auth::user()->update([
            'organizer_id'=>$organizer->id,
            'admin' => 1,
            'accepted' => 1
        ]);

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function show(Organizer $organizer)
    {

        return view('attendee/pages/org_profile', ["organizer"=>$organizer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function edit(Organizer $organizer)
    {
        return view('dashboard/pages/edit_org', ["organizer"=>$organizer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organizer $organizer)
    {
        // dd($request);
        $this->validate(request(), [
            'picture' => 'mimes:jpeg,jpg,png|max:1000'
        ]);
        if($request->picture != null) {
            $picture= null;
            if($request->picture != null) {
                $picture = $request->name. '.png';
                $request->file('picture')->storeAs('public/upload', $picture);
            }
            $organizer->update([
                'name'=>$request->name,
                'description' => $request->description,
                'picture'=> $picture
            ]);

        } else {
                $organizer->update([
                    'name'=>$request->name,
                    'description' => $request->description
                ]);

        }


        return redirect('dashboard/organizer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organizer  $organizer
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Organizer $organizer)
    // {
    //     $organizer->delete();
    //     return redirect('dashboard/organizers');
    // }
}
