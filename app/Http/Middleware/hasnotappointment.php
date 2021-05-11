<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Appointment;

class hasnotappointment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $appointment = Appointment::where('user_id', auth()->user()->id)->get();
        if (count($appointment) == 0)
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('show');
            }
    }
}
