<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AdminChecker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsUserAdmin
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next): Response
{
    if ($request->user() && $request->user()->role === 'admin') {
        return $next($request);
    }

    abort(403);
}

}
