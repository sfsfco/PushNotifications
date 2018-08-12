<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if (!$request->session()->exists('admin') && $request->cookie('remember_me')!='ok') {
    
            return redirect(Route('adminlogin'));
        }
        return $next($request);
    }
}
