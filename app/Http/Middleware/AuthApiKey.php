<?php

namespace App\Http\Middleware;

use App\Helper\FillError;
use Closure;

class AuthApiKey
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
        $session = null;
        if($request->cookie('my_session')) {
             $session = $request->cookie('my_session');
        } else {
            $session = $request->cookie('laravel_session');
        }
        if($session) {
            $request->offsetSet('unique_string',$session);
            $response = $next($request);
            $type = gettype($response);
            if($type != 'object') {
                return response($response)->cookie(
                    'my_session', $session, 15
                );
            }
            $class = get_class($response);
            if($class == 'Illuminate\Http\Response') {
                return $response->cookie(
                    'my_session', $session, 15
                );
            } else {
                return $response;
            }
            
        }
        if(!$request->api_key) {
            $errors = ['api_key_not_found' => ['Không có api key']];
            return FillError::Validation($errors);
        }
        if($request->api_key != getenv('APP_KEY')) {
            $errors = ['api_key_not_vail' => ['Không đúng api key']];
            return FillError::Validation($errors);
        }
        return $next($request);
    }
}
