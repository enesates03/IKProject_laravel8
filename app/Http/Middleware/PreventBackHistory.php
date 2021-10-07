<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
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
        $response = $next($request);
        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT')
//            ->header('Methods','POST, GET, OPTIONS, PUT, PATCH, DELETE')
            ->header('Headers','Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers, X-CSRF-TOKEN');
//        $response = $next($request);
//        $IlluminateResponse = 'Illuminate\Http\Response';
//        $SymfonyResopnse = 'Symfony\Component\HttpFoundation\Response';
//        $headers = [
//            'Access-Control-Allow-Origin' => '*',
//            'Access-Control-Allow-Pragma' => 'no-cache',
////            'Access-Control-Allow-Cache-Control' => 'nocache, no-store, max-age=0, must-revalidate',
////            'Access-Control-Allow-Expires' => 'Sun, 02 Jan 1990 00:00:00 GMT',
//            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
//            'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers, X-CSRF-TOKEN'
//        ];
//
//        if ($response instanceof $IlluminateResponse) {
//            foreach ($headers as $key => $value) {
//                $response->header($key, $value);
//            }
//            return $response;
//        }
//
//        if ($response instanceof $SymfonyResopnse) {
//            foreach ($headers as $key => $value) {
//                $response->headers->set($key, $value);
//            }
//            return $response;
//        }
//
//        return $response;
    }
}
