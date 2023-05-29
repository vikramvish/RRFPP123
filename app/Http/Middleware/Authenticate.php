<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware {
    /**
    * Get the path the user should be redirected to when they are not authenticated.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return string|null
    */

    public function handle( $request, Closure $next, ...$guards ) {

        // if ( !auth()->check() ) {
        //     return redirect()->route( 'login' )->with('fail','First Login');
        // }
      
        // return $next( $request );
        
        if ($request->session()->has('userRights')) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
