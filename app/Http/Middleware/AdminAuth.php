<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        if ($request->session()->has('ADMIN_LOGIN') && $request->session()->has('ADMIN_id')) {
            return $next($request);
        }else{
            $request->session()->flash('error',"Please Login First !!");
            return redirect('admin')->withInput($request->only('email'));
        }
    }
}
