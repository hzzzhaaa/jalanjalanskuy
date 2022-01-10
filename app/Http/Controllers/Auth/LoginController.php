<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Carbon\Carbon;
use Socialite;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }

    /**
    * Redirect the user to the Google authentication page.
    *
    * @return \Illuminate\Http\Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new

            return view('auth/register_google',['user' => $user]);

            // $newUser                  = new User;
            // $newUser->name            = $user->name;
            // $newUser->email           = $user->email;
            // $newUser->google_id       = $user->id;
            // $newUser->role            = 0;
            // $newUser->email_verified_at = Carbon::now();
            // $newUser->save();
            // auth()->login($newUser, true);
        }
        return redirect()->to('/');
    }

    public function registerGoogle(Request $request) {
        $newUser                  = new User;
        $newUser->name            = $request->name;
        $newUser->email           = $request->email;
        $newUser->google_id       = $request->google_id;
        $newUser->phone           = $request->phone;
        $newUser->role            = 0;
        $newUser->email_verified_at = Carbon::now();
        $newUser->save();
        auth()->login($newUser, true);
        return redirect()->to('/');
    }
}
