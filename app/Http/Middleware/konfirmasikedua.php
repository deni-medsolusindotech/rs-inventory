<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class konfirmasikedua
{
   
    public function handle(Request $request, Closure $next)
    {   
        if(auth()->user()->status_verifikasi != 'terima'){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
