<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isadmin
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
        if(auth()->user()->admin)
        {
            return $next($request);
        }

        return redirect()->back()->with('unauthorised', 'You are 
          unauthorised to access this page');
    }
}
