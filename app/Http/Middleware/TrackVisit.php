<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip tracking for admin, api, and asset routes
        $path = $request->path();
        if (
            str_starts_with($path, 'admin') ||
            str_starts_with($path, 'api') ||
            str_starts_with($path, '_debugbar') ||
            preg_match('/\.(css|js|ico|png|jpg|jpeg|gif|svg|webp|woff|woff2)$/i', $path)
        ) {
            return $next($request);
        }

        try {
            Visit::track();
        } catch (\Exception $e) {
            // Don't break the site if tracking fails
            report($e);
        }

        return $next($request);
    }
}
