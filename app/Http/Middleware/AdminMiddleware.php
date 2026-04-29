<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        if (!$request->user()->isAdmin()) {
            abort(403, 'Admin access is required.');
        }

        return $next($request);
    }
}
