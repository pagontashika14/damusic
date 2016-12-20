<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helper\FillError;

class AuthApi
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
        $token = $request->cookie('api_token');
        $request->offsetSet('api_token', $token);
        Auth::setRequest($request);
        if(Auth::check()) {
            $user = Auth::user();
            $timeExpire = Carbon::parse($user->remember_token);
            $now = Carbon::now();
            $dif = $now->diffInMinutes($timeExpire,false);
            if($dif > 0) {
                return $next($request);
            }
        }
        if($request->no_redirect){
            return ['status' => false, 'data' => null];
        } else {
            return redirect()->route('login',['current_link' => $request->path()]);
        }
    }
}
