<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();

        if (!$user) {
            // Not logged in → redirect to login page
            return redirect()->route('login');
        }

        if ($user->role !== $role) {
            // Role mismatch → unauthorized
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }

}







