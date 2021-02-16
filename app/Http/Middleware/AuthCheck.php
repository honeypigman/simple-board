<?php

namespace App\Http\Middleware;

use Closure;
use Func;

class AuthCheck
{
    public function handle($request, Closure $next)
    {
        if(Func::isSession($request)){
                    
            Func::accLog($request);
            
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}