<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictHttpMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->method() !== 'POST') {
            abort(405, 'Method Not Allowed');
        }

        return $next($request);
    }
}
