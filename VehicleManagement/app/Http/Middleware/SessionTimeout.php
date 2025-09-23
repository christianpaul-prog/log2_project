<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SessionTimeout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $loginTime = session('login_time');
            $maxSession = 60*24; // minutes

            if (!$loginTime) {
                session(['login_time' => now()]);
            } else {
                if (Carbon::parse($loginTime)->diffInMinutes(now()) >= $maxSession) {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('auth.login')
                        ->with('error', 'Your session has expired after '.$maxSession.' minutes.');
                }
            }
        }

        return $next($request);
    }
}
