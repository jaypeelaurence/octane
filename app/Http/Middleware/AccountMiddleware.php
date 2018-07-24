<?php

namespace App\Http\Middleware;

use Closure;

class AccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if ($request->user() && $request->user()->id != $request->uid){
            return redirect("error/103");
        }

        return $next($request);
    }
}
