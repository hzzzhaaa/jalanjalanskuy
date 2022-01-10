<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class OrganizerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->isAdmin())
        return $next($request);
        if($user->isOrganizer())
        return $next($request);
        return abort(401, 'Unauthorized action.');
    }
}
