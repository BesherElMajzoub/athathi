<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request - simple token-based auth.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = config('business.admin.token');

        // Check session first
        if ($request->session()->get('admin_authenticated')) {
            return $next($request);
        }

        // Check token in query string for initial login
        if ($request->query('token') === $token) {
            $request->session()->put('admin_authenticated', true);
            return redirect($request->url());
        }

        // Not authenticated
        abort(403, 'Access denied. Please provide a valid admin token.');
    }
}
