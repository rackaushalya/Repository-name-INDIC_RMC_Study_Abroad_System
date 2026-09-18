<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        /*
        |--------------------------------------------------------------------------
        | Check Authentication
        |--------------------------------------------------------------------------
        */

        if (!Auth::check()) {
            return redirect()->route('login');
        }


        /*
        |--------------------------------------------------------------------------
        | Get Logged-in User
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Check User Role
        |--------------------------------------------------------------------------
        */

        if (!$user || !$user->role) {
            abort(403, 'User role not found.');
        }


        /*
        |--------------------------------------------------------------------------
        | Check Allowed Roles
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $user->role->role_name,
            $roles,
            true
        )) {
            abort(403, 'You are not authorized to access this page.');
        }


        /*
        |--------------------------------------------------------------------------
        | Allow Request
        |--------------------------------------------------------------------------
        */

        return $next($request);
    }
}