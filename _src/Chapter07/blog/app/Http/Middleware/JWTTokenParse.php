<?php
namespace App\Http\Middleware;
use Closure;
class JWTTokenParse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(JWTAuth::parseToken());
//        $user = JWTAuth::parseToken()->authenticate();
//
//        if(!$user){
//
//        }

        return $next($request);
    }
}