<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check()){
            $user = Auth::user();
            if (($role == 'admin' && $user->is_admin != 1) || ($role == 'user' && $user->is_admin == 1)) {
                return back();
            }    
        }
        return $next($request);
    }
}