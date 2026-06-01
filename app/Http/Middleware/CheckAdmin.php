<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Middleware untuk memastikan user yang login adalah admin
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak login, redirect ke login
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        // Jika user bukan admin, return forbidden
        if (Auth::user()->role !== 'admin') {
            return response()->view('errors.unauthorized', [], 403);
        }

        return $next($request);
    }
}
