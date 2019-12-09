<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  public function handle($request, Closure $next, $guard = null)
    {
        // if ($request->user()->userType == 0) {
       
        //     return $next($request);
        // }

        if(Auth::user()->userType == 1){
             return $next($request);
        }


           // return redirect('/admin/login');
        return response()->json(['error'=>'Unauthenticated']);
    }
}
