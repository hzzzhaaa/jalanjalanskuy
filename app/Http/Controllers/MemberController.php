<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use Session;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizer = Auth::user()->organizer;
        $members = User::getAllMembersOf($organizer->id)->get();

        return view('dashboard/pages/members', ['members'=> $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function invite(Request $request)
    {
        Log::info('masuk');
        $user = User::where('email', $request->email)->get()->first();
        if($user == null) {
            Log::info('null');
            Session::flash('failed', 'User ' . $request->email . ' tidak terdaftar.');
            return redirect('dashboard/member');
        }
        if($user->isOrganizer() || $user->hasInvitation()) {
            Session::flash('failed', 'User ' . $request->email . ' sudah berada di dalam Organizer.');
            return redirect('dashboard/member');
        }
        $organizerid = Auth::user()->organizer->id;
        $user->organizer_id = $organizerid;
        $user->save();
        Session::flash('success', 'User ' . $request->email . ' berhasil diundang.');
        Log::info('Invited');
        return redirect('dashboard/member');
    }

    public function kick(User $user)
    {
        Log::info('masuk');
        if($user->isInvitedBy(Auth::user()->organizer_id) || $user->isMemberOf(Auth::user()->organizer_id)) {
            Log::info('kicked');
            $user->organizer_id = null;
            $user->accepted = null;
            $user->admin = null;
            $user->save();
            Session::flash('success', 'User ' . $user->name . ' berhasil dikeluarkan.');
            return redirect('dashboard/member');
        }

        Session::flash('failed', 'User ' . $user->email . ' tidak terdaftar di dalam Organizer');
        Log::info('failed');
        return redirect('dashboard/member');
    }

    public function setAdmin(User $user) {
        if($user->isMemberOf(Auth::user()->organizer_id) && !$user->isOrganizerAdmin()) {
            Log::info('now admin');
            $user->admin = 1;
            $user->save();
            Session::flash('success', 'User ' . $user->name . ' berhasil menjadi Admin.');
            return redirect('dashboard/member');
        }

        Session::flash('failed', 'User ' . $user->email . ' tidak terdaftar di dalam Organizer');
        Log::info('failed');
        return redirect('dashboard/member');
    }

    public function revokeAdmin(User $user) {
        if($user->isMemberOf(Auth::user()->organizer_id) && $user->isOrganizerAdmin()) {
            Log::info('revoked');
            $user->admin = null;
            $user->save();
            Session::flash('success', 'User ' . $user->name . ' berhasil menjadi Member.');
            return redirect('dashboard/member');
        }

        Session::flash('failed', 'User ' . $user->email . ' tidak terdaftar di dalam Organizer');
        Log::info('failed');
        return redirect('dashboard/member');
    }

    public function accept() {
        Auth::user()->update([
            'accepted'=> 1
        ]);
        return redirect('dashboard');
    }

    public function decline() {
        Auth::user()->update([
            'organizer_id'=> null
        ]);
        return redirect('');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
