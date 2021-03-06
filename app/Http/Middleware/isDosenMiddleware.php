<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isDosenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check())
        {
            if(request()->user()->hasRole('dosen'))
            {
                return $next($request);
            }else{
                return redirect('dashboard');
            }
        }else{
            return redirect('login');
        }
    }
}
