<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppConfirmation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        if($request->api_key !=env( 'API_KEY')){
            return  response()->json(['message'=>'unauthorized.'] );
        }
        return $next($request);
    }
}
