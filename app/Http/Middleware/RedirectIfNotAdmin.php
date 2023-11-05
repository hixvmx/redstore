<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->isAdmin !== 1)
        {
            return response()->json([
                "error" => true,
                "message" => "You_Do_Not_Have_Permissions_To_Access_This_Page"
            ], 404);
        }

        return $next($request);
    }
}
