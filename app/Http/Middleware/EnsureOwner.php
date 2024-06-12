<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureOwner
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('owner')->check()) {
            return $next($request);
        }

        return redirect('/login'); // Redirect to login page
    }
}
