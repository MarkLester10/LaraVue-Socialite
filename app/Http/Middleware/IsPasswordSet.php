<?php

namespace App\Http\Middleware;

use Closure;

class IsPasswordSet
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->password == 'secret' && !$request->is('admin/setpassword') && !$request->password) {
            return redirect()->route('setpassword');
        }
        return $next($request);
    }
}