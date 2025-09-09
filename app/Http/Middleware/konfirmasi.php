<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class konfirmasi
{
    
    public function handle(Request $request, Closure $next)
    {   
        if(!auth()->user()->confirm){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
