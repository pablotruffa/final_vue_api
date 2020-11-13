<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        
        $origin = $_SERVER['HTTP_ORIGIN'];
        $allowedOrigins = ['http://localhost','http://localhost:8080','http://localhost:8081'];
        
        if(in_array($origin,$allowedOrigins)) {
            return $next($request)
            ->header('Access-Control-Allow-Origin', $origin)
            ->header('Access-Control-Allow-Methods', 'GET, PUT, PATCH, POST, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept')
            ->header('Access-Control-Allow-Credentials', 'true');
        }

        return $next($request);

    }
}
